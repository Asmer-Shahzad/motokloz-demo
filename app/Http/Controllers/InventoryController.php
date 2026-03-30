<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;

class InventoryController extends Controller
{
    private function baseUrl(): string
    {
        return config('services.diskloz.base_url', env('DISKLOZ_BASE_URL', env('diskloz_base_url', '')));
    }

    public function inventory(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 9;

        $url = $this->baseUrl().'/api/inventory?';
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];

        if ($request->filled('txt')) {
            $params['text'] = $request->txt;
        }
        if (auth()->check()) {
            $params['client_id'] = auth()->id();
        }

        $url .= http_build_query($params);

        $response = Http::get($url);
        $result = json_decode($response->body());
        
        $data['buying_products'] = $result->data ?? [];
        $data['current_page'] = $result->current_page ?? 1;
        $data['last_page']    = $result->last_page ?? 1;

        return view('car-listing', $data);
    }

    public function selling(Request $request){
        $response = Http::get($this->baseUrl().'/api/inventory-form');
        $data = json_decode($response->body());
        $array = [];
        foreach ($data as $key => $value) {
                $array[$key] = $value;
        }
        return view('selling', ['array' => $array] );
    }
    
    public function inventory_product_details(Request $request,$id){
        $response_search = Http::get($this->baseUrl().'/api/search_by_id',[
            'id' => $id
        ]);
        $data['searched_vehicle'] = json_decode($response_search);
        $data['contact'] = isset($data['searched_vehicle']->dealer) ? $data['searched_vehicle']->dealer->phone_no : null;
        $data['dealer'] = $vehicle['dealer'] ?? null;
        return view('car-details',$data);
    }

    public function save_inventory(Request $request){
        $payload = $request->all();
        $payload['user_id'] = auth()->user()->id;
        $response = Http::post($this->baseUrl().'/api/inventory-form-save', $payload);
        $data = json_decode($response->body());
        return redirect()->route('selling')->with('info',$data->message);
    }

    public function edit_inventory(Request $request, $id){
        $payload = $request->all();
        $payload['user_id'] = auth()->user()->id;
        $response = Http::post($this->baseUrl().'/api/inventory-form-edit/'.$id, $payload);
        $data = json_decode($response->body());
        return redirect()->route('seller-list')->with('info',$data->message);
    }

    public function sentMessage(Request $request)
    {
        $data_response = Http::post($this->baseUrl().'/api/chat', [
            'message' => $request['message'],
            'client_id' => $request['client_id'],
            'dealer_id'=> $request['dealer_id'],
            'inventory_id'=>$request['inventory_id']
        ]);
        $getchat = $data_response['getChat'];
        $data = ['getchat' => $getchat];
        return view('showChat',$data);
    }

    public function GetRecentMessagesInfo(Request $request)
    {
        $data_response = Http::get($this->baseUrl().'/api/getMessages', [
            'client_id' => $request->has('client_id') ? $request->client_id : '',
            'dealer_id'=> $request->has('dealer_id') ? $request->dealer_id : '',
            'inventory_id'=> $request->has('inventory_id') ? $request->inventory_id : ''
        ]);

        $searched_vehicle = json_decode($data_response['data']);
        $client = $data_response['client'];
        $getchat = $data_response['getChat'];
        $getClientChats = $data_response['getClientChats'];

        $data = [
            'searched_vehicle' => $searched_vehicle,
            'client' => $client,
            'getchat' => $getchat,
            'getClientChats' => $getClientChats,
        ];
        $redirectUrl = '/redirectToChat';
        $request->session()->put('myData', $data);
        return response()->json([
            'redirect_url' => $redirectUrl,
            'data' => $data,
        ]);
    }

    public function redirectToChat(Request $request)
    {
        if($request->session()->has('myData')) {
            $yourData = $request->session()->get('myData');
            return view('recentMessages',$yourData);
        } else {
           return redirect('/login');
        }
    }

    public function getUpdatedMessages(Request $request)
    {
        $data_response = Http::get($this->baseUrl().'/api/getMessages', [
            'client_id' => $request->client_id,
            'dealer_id'=> $request->dealer_id,
            'inventory_id'=>$request->inventory_id
        ]);
        $searched_vehicle = json_decode($data_response['data']);
        $getClientChats = $data_response['getClientChats'];
        $getchat = $data_response['getChat'];
        $htmlForChatLi = view('chatlist', compact('getClientChats', 'searched_vehicle'))->render();
        $htmlForChatList = view('showChat', compact('getchat'))->render();
        return response()->json([
            'htmlForChatLi' => $htmlForChatLi,
            'htmlForChatList' => $htmlForChatList,
        ]);
    }

    public function inventoryDisklozer1(Request $request, $id)
    {
        $response = Http::get($this->baseUrl().'/api/pdf/disklozer/'.$id);
        if ($response->successful()) {
            return response($response->body(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="vehicle_disclosure.pdf"'
            ]);
        }
        abort(404, 'PDF generation failed');
    }

    public function seller_list()
    {
        $response = Http::get($this->baseUrl().'/api/seller_list/'.auth()->user()->id);
        $data['seller_list'] = json_decode($response->body());
        return view('seller_list', ['seller_list' => $data['seller_list']]);
    }

    public function editList($id)
    {
        $response = Http::get($this->baseUrl().'/api/search_by_id', ['id' => $id]);
        $form = Http::get($this->baseUrl().'/api/inventory-form');
        $data = json_decode($form->body());
        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
        return view('editInv', ['inventory' => json_decode($response->body()), 'array' => $array]);
    }

    public function search_keyword(Request $request)
    {
        $response = Http::get($this->baseUrl().'/api/search_keyword',[
            'keyword' => $request->keyword,
            'client_id' => $request->client_id,
        ]);
        $data['searched_vehicle'] = json_decode($response->body());
        return response()->json(['searched_vehicle'=> $data['searched_vehicle']]);
    }

    public function search_filter(Request $request)
    {
        $fullUrl = Http::get($this->baseUrl().'/api/search_filter?',[
            'client_id' => $request->client_id ?? '',
            'condition' => $request->condition ?? '',
            'asset' => $request->asset ?? '',
            'power' => $request->power ?? '',
            'low_price' => $request->low_price ?? '',
            'max_price' => $request->max_price ?? '',
            'year' => $request->year ?? '',
            'make' => $request->make ?? '',
            'model' => $request->model ?? '',
            'mileage' => $request->mileage ?? '',
            'body' => $request->body ?? '',
            'fuel' => $request->fuel ?? '',
            'add_for_sale' => $request->add_for_sale ?? '',
            'keyword' => $request->keyword ?? '',
        ]);
        $data['searched_vehicle'] = json_decode($fullUrl->body());
        return response()->json(['searched_vehicle'=> $data['searched_vehicle']]);
    }

    public function favorites(Request $request)
    {
        $response = Http::get($this->baseUrl().'/api/favorites?client_id='.$request->u);
        $data['favorites'] = json_decode($response->body());
        return view('favorites', ['favorites' => $data['favorites']]);
    }
}
