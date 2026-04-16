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
use Illuminate\Support\Facades\Auth;
use App\Models\UserInformation;

class InventoryController extends Controller
{
    private function baseUrl(): string
    {
        return config('services.diskloz.base_url', env('DISKLOZ_BASE_URL', env('diskloz_base_url', '')));
    }

    public function inventory(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        
        $page = $request->input('page', 1);
        $perPage = 9;

        $url = $this->baseUrl() . '/api/inventory?';
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

        // ✅ Add backend sorting param
        if ($request->filled('sort')) {
            $params['sort'] = $request->sort;
        }

        $url .= http_build_query($params);

        $response = Http::get($url);
        $result = json_decode($response->body());

        $buying_products = collect($result->data ?? []);

        // ✅ Fallback sorting in case API doesn't support it
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $buying_products = $buying_products->sortBy(fn($v) => (float) ($v->disclosed_price ?? 0));
                    break;

                case 'price_desc':
                    $buying_products = $buying_products->sortByDesc(fn($v) => (float) ($v->disclosed_price ?? 0));
                    break;

                case 'year_asc':
                    $buying_products = $buying_products->sortBy(fn($v) => (int) ($v->year ?? 0));
                    break;

                case 'year_desc':
                    $buying_products = $buying_products->sortByDesc(fn($v) => (int) ($v->year ?? 0));
                    break;

                case 'name_asc':
                    $buying_products = $buying_products->sortBy(fn($v) => strtolower($v->title ?? ''));
                    break;

                case 'name_desc':
                    $buying_products = $buying_products->sortByDesc(fn($v) => strtolower($v->title ?? ''));
                    break;
            }
        }

        // ✅ Reset indexes after sorting
        $buying_products = $buying_products->values();

        $current_page = $result->current_page ?? 1;
        $last_page = $result->last_page ?? 1;
        $pageTitle = 'Inventory';

        return view('car-listing', [
            'user' => $user,
            'userInfo' => $userInfo,
            'buying_products' => $buying_products,
            'current_page' => $current_page,
            'last_page' => $last_page,
            'pageTitle' => $pageTitle,
        ]);
    }

    // public function selling(Request $request){
    //     $response = Http::get($this->baseUrl().'/api/inventory-form');
    //     $data = json_decode($response->body());
    //     $array = [];
    //     foreach ($data as $key => $value) {
    //             $array[$key] = $value;
    //     }
    //     return view('selling', ['array' => $array] );
    // }
    
    public function inventory_product_details(Request $request, $id)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        $response_search = Http::get($this->baseUrl() . '/api/search_by_id', [
            'id' => $id
        ]);

        $searched_vehicle = json_decode($response_search->body());

        $videos = $searched_vehicle->videos ?? [];

        // ✅ Source check karo — motokloz hai to local user dhundho
        $isMotokloz = strtolower($searched_vehicle->source ?? '') === 'motokloz';

        $dealer = $searched_vehicle->dealer ?? null;

        if ($isMotokloz && !empty($searched_vehicle->client_id)) {

            // ✅ Seedha local user dhundho — diskloz API skip
            $clientId  = $searched_vehicle->client_id;
            $localUser = \App\Models\User::with('information')->where('id', $clientId)->first();

            if ($localUser) {
                $dealer = $this->buildDealerFromLocalUser($localUser);
            }

        } elseif (!$dealer && !empty($searched_vehicle->client_id)) {

            // ✅ Dealer null hai aur motokloz bhi nahi — diskloz API try karo
            $clientId  = $searched_vehicle->client_id;
            $localUser = \App\Models\User::with('information')->where('id', $clientId)->first();

            if ($localUser) {
                try {
                    $dealerResponse = Http::get($this->baseUrl() . '/api/get_dealer_by_client_id', [
                        'client_id' => $clientId
                    ]);

                    if ($dealerResponse->successful()) {
                        $dealerData = json_decode($dealerResponse->body());

                        $dealer = (!empty($dealerData) && isset($dealerData->id))
                            ? $dealerData
                            : $this->buildDealerFromLocalUser($localUser);
                    } else {
                        $dealer = $this->buildDealerFromLocalUser($localUser);
                    }

                } catch (\Exception $e) {
                    \Log::error('Dealer fetch error: ' . $e->getMessage());
                    $dealer = $this->buildDealerFromLocalUser($localUser);
                }
            }
        }

        $contact = $dealer->phone_no ?? null;

        return view('car-details', [
            'user'             => $user,
            'userInfo'         => $userInfo,
            'searched_vehicle' => $searched_vehicle,
            'videos'           => $videos,
            'contact'          => $contact,
            'dealer'           => $dealer,
            'pageTitle'        => $searched_vehicle->title ?? 'Car Details'
        ]);
    }


    // Controller mein private function
    private function buildDealerFromLocalUser($localUser): object
    {
        $info = $localUser->information;

        return (object) [
            'id'               => $localUser->id,
            'legal_name'       => $info->full_name       ?? $localUser->name ?? 'N/A',
            'first_name'       => $info->full_name       ?? $localUser->name ?? '',
            'last_name'        => '',
            'email'            => $localUser->email      ?? 'N/A',
            'phone_no'         => $info->contact_number  ?? 'N/A',
            'logo'             => $info->avatar          ?? null,
            'city'             => $info->city            ?? null,
            'province'         => null,                         // motokloz has no province field
            'physical_address' => $info->complete_address ?? null,
            'postal_code'      => $info->postalCode      ?? null,
            'country'          => $info->country         ?? null,
            'internal_notes'   => $info->bio             ?? null,
            'is_motokloz_user' => true,
            'inventory'        => [],
        ];
    }

    // public function save_inventory(Request $request){
    //     $payload = $request->all();
    //     $payload['user_id'] = auth()->user()->id;
    //     $response = Http::post($this->baseUrl().'/api/inventory-form-save', $payload);
    //     $data = json_decode($response->body());
    //     return redirect()->route('selling')->with('info',$data->message);
    // }

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
            
            // Get base URL
            $baseUrl = $this->baseUrl();
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
            $response = Http::delete($this->baseUrl() . '/api/remove_like_status', $data);

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
        $response = Http::get($this->baseUrl().'/api/favorites?client_id='.$request->u);
        $data['favorites'] = json_decode($response->body());
        return view('favorites', ['favorites' => $data['favorites']]);
    }
}
