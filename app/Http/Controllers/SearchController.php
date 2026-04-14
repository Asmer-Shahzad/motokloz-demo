<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInformation;
use App\Models\User;

class SearchController extends Controller
{
    private function disklozBaseUrl(): string
    {
        return rtrim(config('services.diskloz.base_url', 'https://diskloz.ca'), '/');
    }

    private function getUserLocation(): array
    {
        $user = Auth::user();

        if (!$user) {
            return [];
        }

        $userInfo = $user->information ?? null;

        if (!$userInfo) {
            return [];
        }

        return [
            'city' => $userInfo->city ?? null,
            'postalCode' => $userInfo->postalCode ?? null,
            'complete_address' => $userInfo->complete_address ?? null,
        ];
    }



    private function motoklozUserLocationMap(): array
    {
        return UserInformation::whereNotNull('postalCode')
            ->orWhereNotNull('city')
            ->get(['user_id', 'postalCode', 'city', 'country'])
            ->keyBy(fn($info) => (string) $info->user_id)
            ->map(fn($info) => [
                'postal_code' => $info->postalCode,
                'city'        => $info->city,
                'country'     => $info->country,
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

        $dealers = $response->json('data', []);
        foreach ($dealers as $dealer) {
            $locationPayload = [
                'postal_code' => $dealer['postal_code'] ?? null,
                'city' => $dealer['city'] ?? null,
                'province' => $dealer['province'] ?? null,
                'country' => $dealer['country'] ?? null,
            ];

            if (!$locationPayload['postal_code'] && !$locationPayload['city']) {
                continue;
            }

            if (!empty($dealer['id'])) {
                $map[(string) $dealer['id']] = $locationPayload;
            }
            if (!empty($dealer['user_id'])) {
                $map[(string) $dealer['user_id']] = $locationPayload;
            }
        }

        return $map;
    }






    public function curl_get($url): JsonResponse
    {
        $json = ["status" => false, "message" => "", "data" => []];
        // $url = "https://portaldesignunit.com/terminal/agents";
        // for sending data as json type
        $apiUrl = $this->disklozBaseUrl() . $url;
        $ch = curl_init($apiUrl);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json', // if the content type is json
            )
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);
        if ($status_code > 199 && $status_code < 203) {
            $json["status"] = true;
        }
        $json["data"] = json_decode($result);
        return response()->json($json);
    }



    public function search_inventory(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        $assets = [
            'AUTO',
            'FARM EQUIPMENT',
            'HEAVY DUTY TRAILERS',
            'HEAVY TRUCK/EQUIPMENT',
            'MARINE',
            'MOTORCYCLE / ATV / POWERSPORTS',
            'RV / TRAILER',
            'SNOWSPORTS',
            'WATERSPORT'
        ];

        $apiData = [
            'selected_make' => $request->selected_make,
            'selected_year' => $request->selected_year,
            'selected_model' => $request->selected_model,
            'selected_body_style' => $request->selected_body_style,
            'selected_mileage' => $request->selected_mileage,
            'selected_condition' => $request->selected_condition,
            'selected_lowest_price' => $request->selected_lowest_price,
            'selected_highest_price' => $request->selected_highest_price,
            'selected_asset' => $request->selected_asset,
            'selected_power' => $request->selected_power_type,
            'selected_fuel' => $request->selected_fuel_type,
            'keywords' => $request->keywords,
            'client_id' => auth()->check() ? auth()->id() : '',
            'page' => $request->page ?? 1,
            'per_page' => 9,
        ];

        $makeTypes = [];
        $bodyStyleTypes = [];

        // ✅ LOOP only for filters (makes + body styles)
        foreach ($assets as $asset) {

            $res = Http::get($this->disklozBaseUrl() . '/api/search_inventory', [
                'selected_asset' => $asset,
                'per_page' => 1,
            ]);

            if ($res->successful()) {
                $inv = json_decode($res->body());

                /** ---------------- MAKES ---------------- */
                switch ($asset) {
                    case 'AUTO':
                        $makes = $inv->filters->MfgAuto ?? [];
                        $bodyStyles = $inv->filters->BodyStyle ?? [];
                        break;

                    case 'SNOWSPORTS':
                        $makes = $inv->filters->MfgSnowsport ?? [];
                        $bodyStyles = $inv->filters->BodyStyleSnowSport ?? [];
                        break;

                    case 'WATERSPORT':
                        $makes = $inv->filters->MfgWatersport ?? [];
                        $bodyStyles = $inv->filters->BodyStyle ?? [];
                        break;

                    case 'MARINE':
                        $makes = $inv->filters->MfgMarine ?? [];
                        $bodyStyles = $inv->filters->BodyStyle ?? [];
                        break;

                    case 'RV / TRAILER':
                        $makes = $inv->filters->MfgRvTrailer ?? [];
                        $bodyStyles = $inv->filters->BodyStyleRvTrailer ?? [];
                        break;

                    case 'MOTORCYCLE / ATV / POWERSPORTS':
                        $makes = $inv->filters->MfgMotorcycleAtv ?? [];
                        $bodyStyles = $inv->filters->BodyStyleMotorcycleAtv ?? [];
                        break;

                    case 'HEAVY TRUCK/EQUIPMENT':
                        $makes = $inv->filters->MfgHeavyTruckEquipment ?? [];
                        $bodyStyles = $inv->filters->BodyStyleHeavyTruckEquipment ?? [];
                        break;

                    case 'HEAVY DUTY TRAILERS':
                        $makes = $inv->filters->MfgHeavyDutyTrailer ?? [];
                        $bodyStyles = $inv->filters->BodyStyleHeavyDutyTrailer ?? [];
                        break;

                    case 'FARM EQUIPMENT':
                        $makes = $inv->filters->MfgFarmEquipment ?? [];
                        $bodyStyles = $inv->filters->BodyStyleFarmEquipment ?? [];
                        break;

                    default:
                        $makes = [];
                        $bodyStyles = [];
                }

                // ✅ Format Makes
                $makeTypes[$asset] = !empty($makes)
                    ? collect($makes)->map(fn($m) => [
                        'id' => $m->id,
                        'name' => $m->name
                    ])->sortBy('name')->values()
                    : collect();

                // ✅ Format Body Styles
                $bodyStyleTypes[$asset] = !empty($bodyStyles)
                    ? collect($bodyStyles)->map(fn($b) => [
                        'id' => $b->id,
                        'name' => $b->name
                    ])->sortBy('name')->values()
                    : collect();
            } else {
                $makeTypes[$asset] = collect();
                $bodyStyleTypes[$asset] = collect();
            }
        }


        // Add sort to API request
        if ($request->filled('sort')) {
            $apiData['sort'] = $request->sort; // backend ko batao
        }

        /** ---------------- MAIN INVENTORY (ONLY ONCE) ---------------- */
        $response = Http::get($this->disklozBaseUrl() . '/api/search_inventory', $apiData);
        $result = json_decode($response->body());

        $inventory = $result->inventory ?? null;

        $dealerLocationMap = $this->dealerLocationMap();
        $motoklozUserMap   = $this->motoklozUserLocationMap();

        $inventoryData = collect($inventory->data ?? [])->map(function ($vehicle) use ($dealerLocationMap, $motoklozUserMap) {
            $dealerKey = (string) ($vehicle->user_id ?? $vehicle->dealer_id ?? '');
            $clientKey = (string) ($vehicle->client_id ?? '');

            // Priority 1: motokloz user_information (most up-to-date, user controls it)
            // Priority 2: diskloz dealer map fallback
            $location = $motoklozUserMap[$dealerKey]
                ?? $motoklozUserMap[$clientKey]
                ?? $dealerLocationMap[$dealerKey]
                ?? [];

            $vehicle->dealer_postal_code = $location['postal_code'] ?? null;
            $vehicle->dealer_city        = $location['city'] ?? null;
            $vehicle->dealer_province    = $location['province'] ?? null;
            $vehicle->dealer_country     = $location['country'] ?? null;
            $vehicle->dealer_complete_address = $location['complete_address'] ?? null;

            return $vehicle;
        })->values();

        // ✅ SORTING (SAFE + CLEAN)
        if ($request->filled('sort')) {
            switch ($request->sort) {

                case 'price_asc':
                    $inventoryData = $inventoryData->sortBy(fn($v) => (float) ($v->price_retail_date ?? 0));
                    break;

                case 'price_desc':
                    $inventoryData = $inventoryData->sortByDesc(fn($v) => (float) ($v->price_retail_date ?? 0));
                    break;

                case 'year_asc':
                    $inventoryData = $inventoryData->sortBy(fn($v) => (int) ($v->year ?? 0));
                    break;

                case 'year_desc':
                    $inventoryData = $inventoryData->sortByDesc(fn($v) => (int) ($v->year ?? 0));
                    break;

                case 'name_asc':
                    $inventoryData = $inventoryData->sortBy(fn($v) => strtolower(trim($v->title ?? '')));
                    break;

                case 'name_desc':
                    $inventoryData = $inventoryData->sortByDesc(fn($v) => strtolower(trim($v->title ?? '')));
                    break;
            }
        }

        // ✅ INDEX RESET (IMPORTANT)
        $inventoryData = $inventoryData->values();

        /** ---------------- FINAL DATA ---------------- */
        $data = [
            'user' => $user,
            'userInfo' => $userInfo,
            'search_inventory_result' => $inventoryData,
            'current_page' => $inventory->current_page ?? 1,
            'last_page' => $inventory->last_page ?? 1,
            'total_inventory' => $inventory->total ?? 0,
            'per_page' => $inventory->per_page ?? 9,

            'assets' => $assets,
            'makeTypes' => $makeTypes,
            'bodyStyleTypes' => $bodyStyleTypes,

            'assetType' => json_decode($this->curl_get('/api/assetType')->getContent())->data ?? [],
            'conditions' => json_decode($this->curl_get('/api/conditions')->getContent())->data ?? [],

            'assetWord' => $request->selected_asset
                ? ucfirst(strtolower($request->selected_asset))
                : 'Car',

            'selected_body_style' => $request->selected_body_style,
            'disklozBaseUrl' => $this->disklozBaseUrl(),
        ];

        return view('car-listing', $data);
    }
}