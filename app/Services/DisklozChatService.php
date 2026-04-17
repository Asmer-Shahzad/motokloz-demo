<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DisklozChatService
{
    public function forwardMessage(
        string $buyerName,
        string $buyerEmail,
        int    $disklozInventoryId,
        string $messageBody,
        ?string $buyerProfileImage = null
    ): array {
        try {
            $payload = [
                'buyer_name'   => $buyerName,
                'buyer_email'  => $buyerEmail,
                'inventory_id' => $disklozInventoryId,
                'message'      => $messageBody,
            ];

            if ($buyerProfileImage) {
                $payload['buyer_profile_image'] = $buyerProfileImage;
            }

            $response = Http::timeout(5)->post(
                $this->baseUrl() . '/api/chat/forward',
                $payload
            );

            if ($response->successful()) {
                return ['success' => true];
            }

            return ['success' => false, 'error' => 'Dealer platform ne message accept nahi kiya.'];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Diskloz API unreachable', ['error' => $e->getMessage()]);
            return ['success' => false, 'error' => 'Dealer se connection nahi ho saka. Baad mein try karein.'];
        }
    }

    private function baseUrl(): string
    {
        return config('services.diskloz.base_url', env('DISKLOZ_BASE_URL', env('diskloz_base_url', '')));
    }

    public function markRead(string $buyerEmail, int $inventoryId): void
    {
        try {
            Http::timeout(3)->post($this->baseUrl() . '/api/chat/mark-read', [
                'inventory_id' => $inventoryId,
                'buyer_email'  => $buyerEmail,
            ]);
        } catch (\Exception $e) {
            // Silent fail — not critical
        }
    }
}
