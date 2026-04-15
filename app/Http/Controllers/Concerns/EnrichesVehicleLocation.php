<?php

namespace App\Http\Controllers\Concerns;

use App\Models\UserInformation;
use Illuminate\Support\Facades\Http;

trait EnrichesVehicleLocation
{
    private function disklozBaseUrl(): string
    {
        return rtrim(config('services.diskloz.base_url', 'https://diskloz.ca'), '/');
    }

    private function motoklozUserLocationMap(): array
    {
        return UserInformation::whereNotNull('postalCode')
            ->orWhereNotNull('city')
            ->get(['user_id', 'postalCode', 'city', 'country', 'complete_address'])
            ->keyBy(fn($info) => (string) $info->user_id)
            ->map(fn($info) => [
                'postal_code'      => $info->postalCode       ?? null,
                'city'             => $info->city             ?? null,
                'country'          => $info->country          ?? null,
                'province'         => null,
                'complete_address' => $info->complete_address ?? null,
            ])
            ->toArray();
    }

    private function dealerLocationMap(): array
    {
        $map = [];
        $response = Http::get($this->disklozBaseUrl() . '/api/all_dealers_with_inventory_count');
        if (!$response->successful()) {
            return $map;
        }

        foreach ($response->json('data', []) as $dealer) {
            $payload = [
                'postal_code' => $dealer['postal_code'] ?? null,
                'city'        => $dealer['city']        ?? null,
                'province'    => $dealer['province']    ?? null,
                'country'     => $dealer['country']     ?? null,
            ];

            if (!$payload['postal_code'] && !$payload['city']) {
                continue;
            }

            if (!empty($dealer['id'])) {
                $map[(string) $dealer['id']] = $payload;
            }
            if (!empty($dealer['user_id'])) {
                $map[(string) $dealer['user_id']] = $payload;
            }
        }

        return $map;
    }

    /**
     * Enrich a single vehicle object with dealer location.
     * Priority: motokloz UserInformation > diskloz dealer map
     */
    private function enrichVehicleLocation(
        object $vehicle,
        array $motoklozMap,
        array $disklozMap
    ): object {
        $dealerKey = (string) ($vehicle->user_id   ?? $vehicle->dealer_id ?? '');
        $clientKey = (string) ($vehicle->client_id ?? '');

        $location = $motoklozMap[$dealerKey]
            ?? $motoklozMap[$clientKey]
            ?? $disklozMap[$dealerKey]
            ?? [];

        $vehicle->dealer_postal_code      = $location['postal_code']      ?? null;
        $vehicle->dealer_city             = $location['city']             ?? null;
        $vehicle->dealer_province         = $location['province']         ?? null;
        $vehicle->dealer_country          = $location['country']          ?? null;
        $vehicle->dealer_complete_address = $location['complete_address'] ?? null;

        return $vehicle;
    }
}
