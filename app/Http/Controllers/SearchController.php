<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    private function disklozBaseUrl(): string
    {
        return rtrim(config('services.diskloz.base_url', 'https://diskloz.ca'), '/');
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



    public function search_inventory(Request $request)
{
    $assets = [
        'AUTO',
        'RV / TRAILER',
        'MOTORCYCLE',
        'POWERSPORTS',
        'HEAVY TRUCK/EQUIPMENT',
        'HEAVY DUTY TRAILERS',
        'FARM EQUIPMENT'
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
        'client_id' => auth()->check() ? auth()->user()->id : '',
        'page' => $request->page ?? 1,
        'per_page' => 9,
    ];

    $makeTypes = [];

    foreach ($assets as $asset) {
        $res = Http::get(env("diskloz_base_url").'/api/search_inventory', [
            'selected_asset' => $asset,
            'per_page' => 1,
        ]);

        if ($res->successful()) {
            $inv = json_decode($res->body());
            
            $makes = [];
            switch($asset) {
                case 'AUTO':
                    $makes = $inv->filters->MfgAuto ?? [];
                    break;
                case 'RV / TRAILER':
                    $makes = $inv->filters->MfgRvTrailer ?? [];
                    break;
                case 'MOTORCYCLE':
                case 'POWERSPORTS':
                    $makes = $inv->filters->MfgMotorcycleAtv ?? [];
                    break;
                case 'HEAVY TRUCK/EQUIPMENT':
                    $makes = $inv->filters->MfgHeavyTruckEquipment ?? [];
                    break;
                case 'HEAVY DUTY TRAILERS':
                    $makes = $inv->filters->MfgHeavyDutyTrailer ?? [];
                    break;
                case 'FARM EQUIPMENT':
                    $makes = $inv->filters->MfgFarmEquipment ?? [];
                    break;
                default:
                    $makes = [];
            }
            
            if (!empty($makes)) {
                $makeTypes[$asset] = collect($makes)
                    ->map(fn($m) => ['id' => $m->id, 'name' => $m->name])
                    ->sortBy('name')
                    ->values();
            } else {
                $makeTypes[$asset] = collect();
            }
        } else {
            $makeTypes[$asset] = collect();
        }

        $response = Http::get($this->disklozBaseUrl() . '/api/search_inventory', $apiData);
        $result = json_decode($response->body());

        $inventory = $result->inventory ?? null;
        $dealerLocationMap = $this->dealerLocationMap();
        $inventoryData = collect($inventory->data ?? [])->map(function ($vehicle) use ($dealerLocationMap) {
            $dealerKey = (string) ($vehicle->user_id ?? $vehicle->dealer_id ?? '');
            $location = $dealerLocationMap[$dealerKey] ?? [];
            $vehicle->dealer_postal_code = $location['postal_code'] ?? null;
            $vehicle->dealer_city = $location['city'] ?? null;
            $vehicle->dealer_province = $location['province'] ?? null;
            $vehicle->dealer_country = $location['country'] ?? null;
            return $vehicle;
        })->values();
        $data = [
            'search_inventory_result' => $inventoryData,
            'current_page' => $inventory->current_page ?? 1,
            'last_page' => $inventory->last_page ?? 1,
            'total_inventory' => $inventory->total ?? 0,
            'per_page' => $inventory->per_page ?? 9,
        ];

        // Filters
        // $data['makeTypes'] = json_decode($this->curl_get('/api/make')->getContent())->data ?? [];
        $data['assetType'] = json_decode($this->curl_get('/api/assetType')->getContent())->data ?? [];
        $data['body_styles'] = json_decode($this->curl_get('/api/body_styles')->getContent())->data ?? [];
        $data['conditions'] = json_decode($this->curl_get('/api/conditions')->getContent())->data ?? [];

        $data['assetWord'] = $request->selected_asset
            ? ucfirst(strtolower($request->selected_asset))
            : 'Car';

        $data['assets'] = $assets;
        $data['makeTypes'] = $makeTypes;
        $data['disklozBaseUrl'] = $this->disklozBaseUrl();

        return view('car-listing', $data);
    }

    $response = Http::get(env('diskloz_base_url') . '/api/search_inventory', $apiData);
    $result = json_decode($response->body());

    $inventory = $result->inventory ?? null;
    
    // Get body styles based on selected asset type
    $bodyStyles = [];
    $selectedAsset = $request->selected_asset;
    
    if ($selectedAsset && isset($result->filters)) {
        switch($selectedAsset) {
            case 'AUTO':
                $bodyStyles = $result->filters->BodyStyle ?? $result->filters->BodyStyle ?? [];
                break;
            case 'RV / TRAILER':
                $bodyStyles = $result->filters->BodyStyleRvTrailer ?? $result->filters->BodyStyle ?? [];
                break;
            case 'MOTORCYCLE':
            case 'POWERSPORTS':
                $bodyStyles = $result->filters->BodyStyleMotorcycleAtv ?? $result->filters->BodyStyle ?? [];
                break;
            case 'HEAVY TRUCK/EQUIPMENT':
                $bodyStyles = $result->filters->BodyStyleHeavyTruckEquipment ?? $result->filters->BodyStyle ?? [];
                break;
            case 'HEAVY DUTY TRAILERS':
                $bodyStyles = $result->filters->BodyStyleHeavyDutyTrailer ?? $result->filters->BodyStyle ?? [];
                break;
            case 'FARM EQUIPMENT':
                $bodyStyles = $result->filters->BodyStyleFarmEquipment ?? $result->filters->BodyStyle ?? [];
                break;
            default:
                $bodyStyles = $result->filters->BodyStyle ?? $result->filters->BodyStyle ?? [];
        }
        
        // Format body styles
        if (!empty($bodyStyles)) {
            $bodyStyles = collect($bodyStyles)
                ->map(fn($style) => [
                    'id' => $style->id,
                    'name' => $style->name
                ])
                ->sortBy('name')
                ->values()
                ->toArray();
        }
    } else {
        // If no asset selected, get all body styles
        if (isset($result->filters->BodyStyle) && !empty($result->filters->BodyStyle)) {
            $bodyStyles = collect($result->filters->BodyStyle)
                ->map(fn($style) => [
                    'id' => $style->id,
                    'name' => $style->name
                ])
                ->sortBy('name')
                ->values()
                ->toArray();
        }
    }

    $data = [
        'search_inventory_result' => $inventory->data ?? [],
        'current_page' => $inventory->current_page ?? 1,
        'last_page' => $inventory->last_page ?? 1,
        'total_inventory' => $inventory->total ?? 0,
        'per_page' => $inventory->per_page ?? 9,
        'body_styles' => $bodyStyles,
    ];

    $data['assetType'] = json_decode($this->curl_get('/api/assetType')->getContent())->data ?? [];
    $data['conditions'] = json_decode($this->curl_get('/api/conditions')->getContent())->data ?? [];

    $data['assetWord'] = $request->selected_asset
        ? ucfirst(strtolower($request->selected_asset))
        : 'Car';

    $data['assets'] = $assets;
    $data['makeTypes'] = $makeTypes;

    // Pass the selected values back to the view
    $data['selected_power_type'] = $request->selected_power_type;
    $data['selected_fuel_type'] = $request->selected_fuel_type;
    $data['selected_seller'] = $request->selected_seller;
    $data['selected_year'] = $request->selected_year;
    $data['selected_body_style'] = $request->selected_body_style;

    return view('car-listing', $data);
}

    

}