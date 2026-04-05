<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaypalWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $eventType = $request->input('event_type');
        $resource = $request->input('resource', []);
        $orderId = $resource['supplementary_data']['related_ids']['order_id'] ?? null;
        $captureId = $resource['id'] ?? null;

        if (! $orderId) {
            Log::warning('paypal.webhook.missing_order_id', $request->all());
            return response()->json(['ok' => true]);
        }

        $payment = Payment::where('provider_order_id', $orderId)->first();
        if (! $payment) {
            Log::warning('paypal.webhook.payment_not_found', ['order_id' => $orderId]);
            return response()->json(['ok' => true]);
        }

        if ($eventType === 'PAYMENT.CAPTURE.COMPLETED') {
            $payment->update([
                'provider_capture_id' => $captureId,
                'status' => 'paid',
                'payload' => $request->all(),
            ]);

            $payment->commande()->update([
                'statut' => 'confirmee',
                'payment_status' => 'paid',
                'paid_at' => now(),
            ]);
        }

        if ($eventType === 'PAYMENT.CAPTURE.DENIED') {
            $payment->update(['status' => 'failed', 'payload' => $request->all()]);
            $payment->commande()->update(['payment_status' => 'failed', 'statut' => 'failed']);
        }

        return response()->json(['ok' => true]);
    }
}
