<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Pagination\LengthAwarePaginator; // ✅ ADD THIS
use Illuminate\Http\JsonResponse;


class DealerProfileController extends Controller
{
    private function disklozBaseUrl(): string
    {
        return rtrim(config('services.diskloz.base_url', 'http://127.0.0.1:8000'), '/');
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

    public function curl_get($url):JsonResponse
    {
        $json = ["status"=>false, "message" => "", "data"=>[]];
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
        if ($status_code > 199 && $status_code < 203){
            $json["status"] = true;
        }
        $json["data"] = json_decode($result);
        return response()->json($json);
    }

    public function dealer_inventory_details($id)
{
    $response = Http::get(env("diskloz_base_url") . '/api/dealer_by_id/' . $id);

    if (!$response->successful()) {
        abort(404, 'Dealer not found');
    }

    $data = $response->json();

    if (!($data['status'] ?? false)) {
        abort(404, 'Dealer not found');
    }

    $dealer = (object) $data['data'];

    // ✅ Location map
    $dealerLocationMap = $this->dealerLocationMap();

    // total inventory count
    $total_inventory = count($dealer->inventory ?? []);

    // ✅ IMPORTANT: enrich inventory with location
    $inventory = collect($dealer->inventory ?? [])
        ->map(function ($item) use ($dealerLocationMap) {

            $item = (object) $item;

            $dealerKey = (string) ($item->user_id ?? $item->dealer_id ?? '');
            $location = $dealerLocationMap[$dealerKey] ?? [];

            // inject location fields
            $item->dealer_postal_code = $location['postal_code'] ?? null;
            $item->dealer_city = $location['city'] ?? null;
            $item->dealer_province = $location['province'] ?? null;
            $item->dealer_country = $location['country'] ?? null;

            return $item;
        })
        ->take(4)
        ->values();

    // ✅ Get the first vehicle from inventory to use as searched_vehicle
    $searched_vehicle = $inventory->first();

    return view('dealer-profile', [
        'dealer'           => $dealer,
        'contact'          => $dealer->phone_no ?? null,
        'inventory'        => $inventory,
        'total_inventory'  => $total_inventory,
        'searched_vehicle' => $searched_vehicle,  // Add this line
        'disklozBaseUrl'   => $this->disklozBaseUrl(),
    ]);
}

    public function dealer_inventory(Request $request, $id)
    {
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
            'selected_power_type' => $request->selected_power_type,
            'selected_fuel_type' => $request->selected_fuel_type,
            'keywords' => $request->keywords,
            'client_id' => auth()->check() ? auth()->user()->id : '',
            'page' => $request->page ?? 1,
            'per_page' => 9,
        ];

        $apiData = array_filter($apiData, fn($value) => $value !== null && $value !== '' && $value !== []);

        $makeTypes = [];

        foreach ($assets as $asset) {
            try {
                $res = Http::timeout(30)->get(env("diskloz_base_url") . '/api/dealer_by_id/' . $id, [
                    'selected_asset' => $asset,
                    'per_page' => 1,
                ]);

                if ($res->successful()) {
                    $inv = json_decode($res->body());
                    $makes = [];
                    switch($asset) {
                        case 'AUTO': $makes = $inv->filters->MfgAuto ?? []; break;
                        case 'MARINE': $makes = $inv->filters->MfgMarine ?? []; break;
                        case 'SNOWSPORTS': $makes = $inv->filters->MfgSnowsport ?? []; break;
                        case 'WATERSPORT': $makes = $inv->filters->MfgWatersport ?? []; break;
                        case 'RV / TRAILER': $makes = $inv->filters->MfgRvTrailer ?? []; break;
                        case 'MOTORCYCLE / ATV / POWERSPORTS': $makes = $inv->filters->MfgMotorcycleAtv ?? []; break;
                        case 'HEAVY TRUCK/EQUIPMENT': $makes = $inv->filters->MfgHeavyTruckEquipment ?? []; break;
                        case 'HEAVY DUTY TRAILERS': $makes = $inv->filters->MfgHeavyDutyTrailer ?? []; break;
                        case 'FARM EQUIPMENT': $makes = $inv->filters->MfgFarmEquipment ?? []; break;
                    }

                    $makeTypes[$asset] = !empty($makes)
                        ? collect($makes)->map(fn($m) => ['id' => $m->id, 'name' => $m->name])->sortBy('name')->values()->toArray()
                        : [];
                } else {
                    $makeTypes[$asset] = [];
                }
            } catch (\Exception $e) {
                \Log::error('Error fetching makes for asset ' . $asset . ': ' . $e->getMessage());
                $makeTypes[$asset] = [];
            }
        }

        try {
            $response = Http::timeout(30)->get(env("diskloz_base_url") . '/api/dealer_by_id/' . $id, $apiData);

            if (!$response->successful()) abort(404, 'Dealer not found');

            $result = $response->json();
            if (!($result['status'] ?? false)) abort(404, 'Dealer not found');

            $dealer = (object) $result['data'];
            $inventory = $dealer->inventory ?? [];
            $filters = (object) ($result['filters'] ?? []);
            $dealerLocationMap = $this->dealerLocationMap();

            $inventoryData = collect($inventory)->map(function ($vehicle) use ($dealerLocationMap) {
                $vehicle = (object) $vehicle;
                $dealerKey = (string) ($vehicle->user_id ?? $vehicle->dealer_id ?? '');
                $location = $dealerLocationMap[$dealerKey] ?? [];
                $vehicle->dealer_postal_code = $location['postal_code'] ?? null;
                $vehicle->dealer_city = $location['city'] ?? null;
                $vehicle->dealer_province = $location['province'] ?? null;
                $vehicle->dealer_country = $location['country'] ?? null;
                return $vehicle;
            })->values();

            // Body styles
            $bodyStyles = [];
            $selectedAsset = $request->selected_asset;
            if ($selectedAsset && isset($result['filters'])) {
                $filtersArray = $result['filters'];
                switch($selectedAsset) {
                    case 'AUTO': $bodyStylesData = $filtersArray['BodyStyle'] ?? []; break;
                    case 'MARINE': $bodyStylesData = $filtersArray['BodyStyle'] ?? []; break;
                    case 'WATERSPORT': $bodyStylesData = $filtersArray['BodyStyle'] ?? []; break;
                    case 'SNOWSPORTS': $bodyStylesData = $filtersArray['BodyStyleSnowSport'] ?? []; break;
                    case 'RV / TRAILER': $bodyStylesData = $filtersArray['BodyStyleRvTrailer'] ?? []; break;
                    case 'MOTORCYCLE / ATV / POWERSPORTS': $bodyStylesData = $filtersArray['BodyStyleMotorcycleAtv'] ?? []; break;
                    case 'HEAVY TRUCK/EQUIPMENT': $bodyStylesData = $filtersArray['BodyStyleHeavyTruckEquipment'] ?? []; break;
                    case 'HEAVY DUTY TRAILERS': $bodyStylesData = $filtersArray['BodyStyleHeavyDutyTrailer'] ?? []; break;
                    case 'FARM EQUIPMENT': $bodyStylesData = $filtersArray['BodyStyleFarmEquipment'] ?? []; break;
                    default: $bodyStylesData = $filtersArray['BodyStyle'] ?? [];
                }

                if (!empty($bodyStylesData)) {
                    $bodyStyles = collect($bodyStylesData)
                        ->map(fn($style) => [
                            'id' => is_array($style) ? ($style['id'] ?? null) : ($style->id ?? null),
                            'name' => is_array($style) ? ($style['name'] ?? '') : ($style->name ?? '')
                        ])
                        ->filter(fn($style) => !empty($style['name']))
                        ->sortBy('name')
                        ->values()
                        ->toArray();
                }
            }

            // Pagination
            $perPage = 9;
            $currentPage = $request->page ?? 1;

            $currentItems = $inventoryData->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $totalInventory = $inventoryData->count();

            // Results info
            $start = $totalInventory > 0 ? (($currentPage - 1) * $perPage + 1) : 0;
            $end = min($currentPage * $perPage, $totalInventory);

            $paginatedInventory = new \Illuminate\Pagination\LengthAwarePaginator(
                $currentItems,
                $totalInventory,
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            // Asset types and conditions
            $assetType = [];
            try {
                $assetTypeResponse = Http::timeout(30)->get(env("diskloz_base_url") . '/api/assetType');
                if ($assetTypeResponse->successful()) $assetType = $assetTypeResponse->json()['data'] ?? [];
            } catch (\Exception $e) { \Log::error('Error fetching asset types: ' . $e->getMessage()); }

            $conditions = [];
            try {
                $conditionsResponse = Http::timeout(30)->get(env("diskloz_base_url") . '/api/conditions');
                if ($conditionsResponse->successful()) $conditions = $conditionsResponse->json()['data'] ?? [];
            } catch (\Exception $e) { \Log::error('Error fetching conditions: ' . $e->getMessage()); }

            // Pass data to view
            $data = [
                'dealer' => $dealer,
                'inventory' => $paginatedInventory,
                'search_inventory_result' => $currentItems,
                'current_page' => $paginatedInventory->currentPage(),
                'last_page' => $paginatedInventory->lastPage(),
                'total_inventory' => $totalInventory,
                'start' => $start,
                'end' => $end,
                'per_page' => $perPage,
                'body_styles' => $bodyStyles,
                'assetType' => $assetType,
                'conditions' => $conditions,
                'assetWord' => $request->selected_asset ? ucfirst(strtolower($request->selected_asset)) : 'Car',
                'assets' => $assets,
                'makeTypes' => $makeTypes,
                'disklozBaseUrl' => $this->disklozBaseUrl(),
                'selected_power_type' => $request->selected_power_type,
                'selected_fuel_type' => $request->selected_fuel_type,
                'selected_seller' => $request->selected_seller,
                'selected_year' => $request->selected_year,
                'selected_body_style' => $request->selected_body_style,
                'selected_make' => $request->selected_make,
                'selected_model' => $request->selected_model,
                'selected_mileage' => $request->selected_mileage,
                'selected_condition' => $request->selected_condition,
                'selected_lowest_price' => $request->selected_lowest_price,
                'selected_highest_price' => $request->selected_highest_price,
                'selected_asset' => $request->selected_asset,
                'keywords' => $request->keywords,
            ];

            return view('dealer', $data);

        } catch (\Exception $e) {
            \Log::error('Error in dealer_inventory: ' . $e->getMessage());
            abort(500, 'An error occurred while fetching dealer inventory');
        }
    }
}
