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
        return UserInformation::whereNotNull('user_id')
            ->with('user:id,email')
            ->get(['user_id', 'full_name', 'avatar', 'postalCode', 'city', 'country', 'complete_address', 'contact_number'])
            ->keyBy(fn($info) => (string) $info->user_id)
            ->map(fn($info) => [
                'postal_code'      => $info->postalCode       ?? null,
                'city'             => $info->city             ?? null,
                'country'          => $info->country          ?? null,
                'province'         => null,
                'complete_address' => $info->complete_address ?? null,
                'phone_no'         => $info->contact_number   ?? null,
                'dealer_name'      => $info->full_name        ?? null,
                'dealer_avatar'    => $info->avatar           ?? null,
                'dealer_email'     => $info->user->email      ?? null,
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
                'postal_code'   => $dealer['postal_code'] ?? null,
                'city'          => $dealer['city']        ?? null,
                'province'      => $dealer['province']    ?? null,
                'country'       => $dealer['country']     ?? null,
                'phone_no'      => $dealer['phone_no']    ?? $dealer['phone'] ?? null,
                'dealer_name'   => $dealer['dba']         ?? $dealer['first_name'] ?? $dealer['name'] ?? null,
                'dealer_avatar' => $dealer['logo']        ?? $dealer['avatar'] ?? null,
                'dealer_email'  => $dealer['email']       ?? null,
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
        $vehicle->dealer_phone_no         = $location['phone_no']         ?? null;
        $vehicle->dealer_name             = $location['dealer_name']      ?? null;
        $vehicle->dealer_avatar           = $location['dealer_avatar']    ?? null;
        $vehicle->dealer_email            = $location['dealer_email']     ?? null;

        return $vehicle;
    }
}
