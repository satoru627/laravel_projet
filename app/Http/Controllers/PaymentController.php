<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Payment;
use App\Services\Payment\PayPalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(private readonly PayPalService $payPalService)
    {
    }

    public function createPaypalOrder(Commande $commande): JsonResponse
    {
        abort_unless($commande->user_id === auth()->id(), 403);

        $payload = $this->payPalService->createOrder(
            (string) $commande->id,
            (float) $commande->total,
            config('services.paypal.currency', 'USD')
        );

        Payment::updateOrCreate(
            ['commande_id' => $commande->id],
            [
                'provider' => 'paypal',
                'provider_order_id' => $payload['id'] ?? null,
                'amount' => $commande->total,
                'currency' => config('services.paypal.currency', 'USD'),
                'status' => 'pending',
                'payload' => $payload,
            ]
        );

        return response()->json([
            'id' => $payload['id'] ?? null,
            'status' => $payload['status'] ?? 'CREATED',
        ]);
    }

    public function capturePaypalOrder(Commande $commande): JsonResponse
    {
        abort_unless($commande->user_id === auth()->id(), 403);

        $payment = $commande->payment;
        abort_unless($payment && $payment->provider_order_id, 422, 'Aucun paiement PayPal initialisé.');

        $capture = $this->payPalService->captureOrder($payment->provider_order_id);
        $captureId = data_get($capture, 'purchase_units.0.payments.captures.0.id');

        $payment->update([
            'provider_capture_id' => $captureId,
            'status' => 'paid',
            'payload' => $capture,
        ]);

        $commande->update([
            'statut' => 'confirmee',
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        Log::info('paypal.capture.success', ['commande_id' => $commande->id, 'capture_id' => $captureId]);

        return response()->json(['ok' => true]);
    }

    public function payer(Commande $commande)
    {
        return view('commandes.payer', compact('commande'));
    }
   
    
}
