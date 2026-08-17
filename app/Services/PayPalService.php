<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayPalService
{
    private function baseUrl(): string
    {
        return rtrim(config('services.paypal.base_url'), '/');
    }

    private function getAccessToken(): string
    {
        $response = Http::asForm()
            ->withBasicAuth(
                config('services.paypal.client_id'),
                config('services.paypal.client_secret')
            )
            ->post($this->baseUrl() . '/v1/oauth2/token', [
                'grant_type' => 'client_credentials',
            ]);

        if ($response->failed()) {
            throw new RuntimeException('Unable to authenticate with PayPal.');
        }

        return $response->json('access_token');
    }

    public function createOrder(float $amount, string $invoiceCode): array
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->post($this->baseUrl() . '/v2/checkout/orders', [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => $invoiceCode,
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($amount, 2, '.', ''),
                    ],
                ]],
                'application_context' => [
                    'return_url' => route('payments.paypal.success'),
                    'cancel_url' => route('payments.paypal.cancel'),
                ],
            ]);

        if ($response->failed()) {
            throw new RuntimeException('Unable to create PayPal order.');
        }

        return $response->json();
    }

    public function captureOrder(string $orderId): array
    {
        try {
            $response = Http::withToken($this->getAccessToken())
                ->acceptJson()
                ->withBody('{}', 'application/json')
                ->post($this->baseUrl() . "/v2/checkout/orders/{$orderId}/capture");

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'capture_id' => null,
                    'response' => $response->json(),
                ];
            }

            $data = $response->json();
            $captureId = data_get($data, 'purchase_units.0.payments.captures.0.id');

            return [
                'success' => true,
                'capture_id' => $captureId,
                'response' => $data,
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'capture_id' => null,
                'response' => ['message' => $e->getMessage()],
            ];
        }
    }
}