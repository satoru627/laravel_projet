<?php

namespace App\Services\Payment;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayPalService
{
    public function createOrder(string $referenceId, float $amount, string $currency = 'USD'): array
    {
        $response = Http::withToken($this->accessToken())
            ->acceptJson()
            ->post($this->baseUrl().'/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => $referenceId,
                    'amount' => [
                        'currency_code' => $currency,
                        'value' => number_format($amount, 2, '.', ''),
                    ],
                ]],
            ]);

        if (! $response->successful()) {
            throw new RuntimeException('PayPal create order failed.');
        }

        return $response->json();
    }

    public function captureOrder(string $paypalOrderId): array
    {
        $response = Http::withToken($this->accessToken())
            ->acceptJson()
            ->post($this->baseUrl()."/v2/checkout/orders/{$paypalOrderId}/capture");

        if (! $response->successful()) {
            throw new RuntimeException('PayPal capture failed.');
        }

        return $response->json();
    }

    protected function accessToken(): string
    {
        $response = Http::withBasicAuth(
            (string) config('services.paypal.client_id'),
            (string) config('services.paypal.client_secret')
        )->asForm()->post($this->baseUrl().'/v1/oauth2/token', [
            'grant_type' => 'client_credentials',
        ]);

        if (! $response->successful() || ! isset($response->json()['access_token'])) {
            throw new RuntimeException('Unable to authenticate with PayPal.');
        }

        return $response->json()['access_token'];
    }

    protected function baseUrl(): string
    {
        return rtrim(config('services.paypal.base_url'), '/');
    }
}
