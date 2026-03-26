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
        return rtrim(config('services.diskloz.base_url', 'http://127.0.0.1:98'), '/');
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
            'selected_power' => $request->selected_power,
            'selected_fuel' => $request->selected_fuel,
            'keywords' => $request->keywords,
            'client_id' => auth()->check() ? auth()->user()->id : '',
            'page' => $request->page ?? 1,
            'per_page' => 9,
        ];

        $makeTypes = []; // initialize before the loop

        foreach ($assets as $asset) {
            $res = Http::get($this->disklozBaseUrl() . '/api/search_inventory', [
                'selected_asset' => $asset,
                'per_page' => 1, // only need filters
            ]);

            if ($res->successful()) {
                $inv = json_decode($res->body());
                if (!empty($inv->filters) && !empty($inv->filters->MfgAuto)) {
                    $makeTypes[$asset] = collect($inv->filters->MfgAuto)
                        ->map(fn($m) => ['id' => $m->id, 'name' => $m->name])
                        ->sortBy('name')
                        ->values();
                } else {
                    $makeTypes[$asset] = collect(); // empty collection if no makes
                }
            } else {
                $makeTypes[$asset] = collect(); // also empty if API fails
            }
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


    

}

