<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{


    public function curl_get($url):JsonResponse
    {
        $json = ["status"=>false, "message" => "", "data"=>[]];
        // $url = "https://portaldesignunit.com/terminal/agents";
        // for sending data as json type
        $apiUrl = env("diskloz_base_url").$url;
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
    $selected_make = '';

    if($request->selected_make_1) $selected_make = $request->selected_make_1;
    elseif($request->selected_make_2) $selected_make = $request->selected_make_2;
    elseif($request->selected_make_3) $selected_make = $request->selected_make_3;
    elseif($request->selected_make_4) $selected_make = $request->selected_make_4;
    elseif($request->selected_make_5) $selected_make = $request->selected_make_5;
    elseif($request->selected_make_6) $selected_make = $request->selected_make_6;
    elseif($request->selected_make_7) $selected_make = $request->selected_make_7;
    elseif($request->selected_make_8) $selected_make = $request->selected_make_8;
    elseif($request->selected_make_9) $selected_make = $request->selected_make_9;

    // Inventory search API
    $response_inventory = Http::get(env("diskloz_base_url").'/api/search_inventory', [
        'selected_make' => $selected_make,
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
        'page' => $request->page ?? 1
    ]);

    $inventory = json_decode($response_inventory->body());

    // Inventory results
    $data['search_inventory_result'] = $inventory->data ?? [];

    // Pagination variables
    $data['current_page'] = $inventory->current_page ?? 1;
    $data['last_page'] = $inventory->last_page ?? 1;

    // Other APIs
    $response_make = json_decode($this->curl_get('/api/make')->getContent());
    $data['makes'] = $response_make->data;

    $response_assetType = json_decode($this->curl_get('/api/assetType')->getContent());
    $data['assetType'] = $response_assetType->data;

    $response_body_styles = json_decode($this->curl_get('/api/body_styles')->getContent());
    $data['body_styles'] = $response_body_styles->data;

    $response_conditions = json_decode($this->curl_get('/api/conditions')->getContent());
    $data['conditions'] = $response_conditions->data;

    // Dynamic heading word
    $assetWord = 'Car';
    if ($request->selected_asset) {
        $assetWord = $request->selected_asset;
    }

    $data['assetWord'] = $assetWord;

    return view('car-listing', $data);
}



    

}

