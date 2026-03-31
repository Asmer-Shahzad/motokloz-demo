<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function inventory(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 9;

        // Build API URL with all parameters
        $url = env("diskloz_base_url").'/api/inventory?';
        // dd(env("diskloz_base_url"));
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
        
        // Items for the loop
        $data['buying_products'] = $result->data ?? [];

        // Pagination variables for the partial
        $data['current_page'] = $result->current_page ?? 1;
        $data['last_page']    = $result->last_page ?? 1;

        return view('car-listing', $data);
    }


    public function selling(Request $request){

        $response = Http::get(env("diskloz_base_url").'/api/inventory-form');
        $data = json_decode($response->body());
        $array = [];
        foreach ($data as $key => $value) {
                $array[$key] = $value;
        }
        return view('selling', ['array' => $array] );
    }
    
    public function inventory_product_details(Request $request,$id){
        $response_search = Http::get(env("diskloz_base_url").'/api/search_by_id',[
            'id' => $id
        ]);
        // dd(json_decode($response_search->body()));
        $data['searched_vehicle'] = json_decode($response_search);
        $data['contact'] = isset($data['searched_vehicle']->dealer) ? $data['searched_vehicle']->dealer->phone_no : null;
        $data['dealer'] = $vehicle['dealer'] ?? null;
        return view('car-details',$data);
    }

    public function save_inventory(Request $request){
        $payload = $request->all();
        $payload['user_id'] = auth()->user()->id;
           $response = Http::post(env("diskloz_base_url").'/api/inventory-form-save',  $payload);
           $data = json_decode($response->body());
        return redirect()->route('selling')->with('info',$data->message);
    }

    public function edit_inventory(Request $request, $id){
        $payload = $request->all();
        $payload['user_id'] = auth()->user()->id;
           $response = Http::post(env("diskloz_base_url").'/api/inventory-form-edit/'.$id,  $payload);
           $data = json_decode($response->body());
        return redirect()->route('seller-list')->with('info',$data->message);
    }


    public function sentMessage(Request $request)
    {
            $data_response = Http::post(env("diskloz_base_url").'/api/chat', [
                'message' => $request['message'],
                'client_id' => $request['client_id'],
                'dealer_id'=> $request['dealer_id'],
                'inventory_id'=>$request['inventory_id']
            ]);
            $getchat = $data_response['getChat'];
            $data = [
                'getchat' => $getchat,
            ];
        return view('showChat',$data);
    }



    public function GetRecentMessagesInfo(Request $request)
    {
        $data_response = Http::get(env("diskloz_base_url").'/api/getMessages', [
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
        if($request->session()->has('myData'))
        {
            $yourData = $request->session()->get('myData');
            return view('recentMessages',$yourData);
        }
        else {
           return redirect('/login');
        }

    }

    public function getUpdatedMessages(Request $request)
    {
        $data_response = Http::get(env("diskloz_base_url").'/api/getMessages', [
            'client_id' => $request->client_id,
            'dealer_id'=> $request->dealer_id,
            'inventory_id'=>$request->inventory_id
        ]);
        $searched_vehicle = json_decode($data_response['data']);
        $getClientChats = $data_response['getClientChats'];
        $getchat = $data_response['getChat'];
        $data = [
            'searched_vehicle' => $searched_vehicle,
            'getchat' => $getchat,
            'getClientChats' => $getClientChats
        ];
        $htmlForChatLi = view('chatlist', compact('getClientChats', 'searched_vehicle'))->render();
        $htmlForChatList = view('showChat', compact('getchat'))->render();

        $responseData = [
            'htmlForChatLi' => $htmlForChatLi,
            'htmlForChatList' => $htmlForChatList,
        ];
        return response()->json($responseData);
            // return view('showChat',$data);

    }

    public function inventoryDisklozer1(Request $request, $id)
    {
        $response = Http::get(env("diskloz_base_url").'/api/pdf/disklozer/'.$id);
        if ($response->successful()) {
            $pdfContent = $response->body();
            // dd($pdfContent);
            // Example: Save the PDF to a file
            // file_put_contents('path/to/save/vehicle_disclosure.pdf', $pdfContent);

            // Or return it directly to the browser
            return response($pdfContent, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="vehicle_disclosure.pdf"'
            ]);
        }

        else {
            // Handle error
            abort(404, 'PDF generation failed');
        }
    }

    public function seller_list()
    {
        $response = Http::get(env("diskloz_base_url").'/api/seller_list/'.auth()->user()->id);
        $data['seller_list'] = json_decode($response->body());
        return view('seller_list', ['seller_list' => $data['seller_list']]);
    }
    public function editList($id)
    {
        $response = Http::get(env("diskloz_base_url").'/api/search_by_id',[
            'id' => $id
        ]);
        $form = Http::get(env("diskloz_base_url").'/api/inventory-form');
        $data = json_decode($form->body());
        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
        $data = json_decode($response->body());
        return view('editInv', ['inventory' => json_decode($response->body()), 'array' => $array]);
    }
    public function search_keyword(Request $request)
    {
        $response = Http::get(env("diskloz_base_url").'/api/search_keyword',[
            'keyword' => $request->keyword,
            'client_id' => $request->client_id,
        ]);

        $data['searched_vehicle'] = json_decode($response->body());

        return response()->json(['searched_vehicle'=> $data['searched_vehicle']]);
    }




    public function search_filter(Request $request)
    {


        $fullUrl =Http::get(env("diskloz_base_url").'/api/search_filter?' ,[
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
        // dd($fullUrl);
        $data['searched_vehicle'] = json_decode($fullUrl->body());

        return response()->json(['searched_vehicle'=> $data['searched_vehicle']]);
    }

    // Local frontend controller
    // public function update_like_status(Request $request){
    //     $data = [
    //         'client_id' => $request->client_id,
    //         'inventory_id' => $request->vehicle_id ?? $request->inventory_id,
    //         'status' => $request->status
    //     ];

    //     if ($request->status == 'liked') {
    //         // POST → add like
    //         $response = Http::post(env("diskloz_base_url") . '/api/update_like_status', $data);
    //     } else {
    //         // DELETE → remove like
    //         $response = Http::withBody(json_encode(['id' => $request->vehicle_id ?? $request->inventory_id]), 'application/json')
    //                         ->delete(env("diskloz_base_url") . '/api/remove_like_status');
    //     }

    //     return $response->json();
    // }

    public function add_like(Request $request)
    {
        try {
            // Log incoming request
            Log::info('Add like request received:', $request->all());
            
            // Get data (support both JSON and form data)
            $clientId = $request->input('client_id');
            $vehicleId = $request->input('vehicle_id');
            
            // If not found in input, try JSON
            if (!$clientId) {
                $clientId = $request->json('client_id');
            }
            if (!$vehicleId) {
                $vehicleId = $request->json('vehicle_id');
            }
            
            // Validate data
            if (!$clientId || !$vehicleId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Missing required fields: client_id and vehicle_id are required',
                    'received' => $request->all()
                ], 400);
            }
            
            // Prepare data for external API
            $data = [
                'client_id' => $clientId,
                'inventory_id' => $vehicleId
            ];
            
            // Get base URL from env
            $baseUrl = env('DISKLOZ_BASE_URL');
            if (!$baseUrl) {
                return response()->json([
                    'success' => false,
                    'message' => 'DISKLOZ_BASE_URL not configured in .env file'
                ], 500);
            }
            
            // Call external API
            $response = Http::timeout(30)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post($baseUrl . '/api/update_like_status', $data);
            
            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::error('External API error:', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add like',
                    'details' => $response->body()
                ], $response->status());
            }
            
        } catch (\Exception $e) {
            Log::error('Add like exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function remove_like(Request $request)
    {
        try {
            $data = [
                'client_id' => $request->client_id,
                'inventory_id' => $request->vehicle_id
            ];

            // Use DELETE for removing
            $response = Http::delete(env("DISKLOZ_BASE_URL") . '/api/remove_like_status', $data);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to remove like'
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }


    public function favorites(Request $request)
    {
        $response = Http::get(env("diskloz_base_url").'/api/favorites?client_id='.$request->u);
        $data['favorites'] = json_decode($response->body());
        // dd($data['favorites']);
        return view('favorites', ['favorites' => $data['favorites']]);
    }
}
