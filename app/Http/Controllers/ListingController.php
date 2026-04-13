<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator; // ✅ ADD THIS
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Support\Facades\Log;
use App\Models\Inventory;
use App\Models\InventoryExtraService;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInformation;


class ListingController extends Controller
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


    public function listingsIndex(Request $request)
{
    $user = Auth::user();
    $userInfo = $user->information ?? new UserInformation();
    
    // Get logged-in user's location
    $userLocation = $this->getUserLocation();

    // Base query
    $query = Inventory::where('user_id', auth()->id())->with('extraServices');
    
    // Apply search filter
    $search = $request->get('search');
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
            ->orWhere('model', 'LIKE', "%{$search}%")
            ->orWhere('type', 'LIKE', "%{$search}%")
            ->orWhere('condition', 'LIKE', "%{$search}%")
            ->orWhere('stock_number', 'LIKE', "%{$search}%")
            ->orWhere('mileage', 'LIKE', "%{$search}%")
            ->orWhere('transmission', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('features', 'LIKE', "%{$search}%");
            
            // Numeric fields ke liye exact match ya range search
            if (is_numeric($search)) {
                $q->orWhere('price', $search);
            } else {
                $q->orWhere('price', 'LIKE', "%{$search}%");
            }
        });
    }
    
    // Apply sorting based on request
    $sort = $request->get('sort', 'newest');
    
    switch ($sort) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'newest':
            $query->latest();
            break;
        case 'oldest':
            $query->oldest();
            break;
        default:
            $query->latest();
            break;
    }
    
    $listings = $query->get();

    // Enrich listings with user's location data
    $listingsCollection = $listings->map(function ($listing) use ($userLocation) {
        $listing->dealer_postal_code = $userLocation['postalCode'] ?? null;
        $listing->dealer_city = $userLocation['city'] ?? null;
        $listing->dealer_country = $userLocation['country'] ?? null;
        $listing->dealer_complete_address = $userLocation['complete_address'] ?? null;
        
        return $listing;
    });

    $total_listings = $listingsCollection->count();

    $perPage = 6;
    $currentPage = $request->get('page', 1);

    $listings = new LengthAwarePaginator(
        $listingsCollection->forPage($currentPage, $perPage),
        $total_listings,
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    $last_page = $listings->lastPage();
    $current_page = $listings->currentPage();
    $pageTitle = 'Listings';
    
    // Current sort and search for view
    $currentSort = $request->get('sort', 'newest');
    $searchTerm = $request->get('search', '');

    return view('listings', compact(
        'user',
        'userInfo',
        'listings',
        'pageTitle',
        'last_page',       
        'current_page',
        'currentSort',
        'searchTerm'
    ));
}

    public function user_inventory_product_details(Request $request, $id)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        $searched_vehicle = Inventory::where('user_id', auth()->id())
            ->with('extraServices')
            ->where('id', $id)
            ->first(); // 👈 single record

        if (!$searched_vehicle) {
            abort(404);
        }

        return view('listing-car-details', compact('searched_vehicle' , 'user', 'userInfo'));
    }

    public function loadAssetForm(Request $request)
    {
        $asset = $request->asset;

        $partialMap = [
            'AUTO' => 'listings-form.auto',
            'FARM EQUIPMENT' => 'listings-form.farm_equipment',
            'HEAVY DUTY TRAILERS' => 'listings-form.heavy_duty_trailers',
            'HEAVY TRUCK/EQUIPMENT' => 'listings-form.heavy_truck_equipment',
            'MARINE' => 'listings-form.marine',
            'MOTORCYCLE / ATV / POWERSPORTS' => 'listings-form.motorcycle_atv_powersports',
            'RV / TRAILER' => 'listings-form.rv_trailer',
            'SNOWSPORTS' => 'listings-form.snowsports',
            'WATERSPORT' => 'listings-form.watersport',
        ];

        $view = $partialMap[$asset] ?? 'listings-form.default';

        // -------- FILTERS API --------
        $res = Http::get(env("diskloz_base_url").'/api/search_inventory', [
            'selected_asset' => $asset,
            'per_page' => 1,
        ]);

        $inv = json_decode($res->body());

        $makes = [];
        $bodyStyles = [];

        $map = [
            'AUTO' => ['make' => 'MfgAuto', 'body' => 'BodyStyle'],
            'SNOWSPORTS' => ['make' => 'MfgSnowsport', 'body' => 'BodyStyleSnowSport'],
            'WATERSPORT' => ['make' => 'MfgWatersport', 'body' => 'BodyStyle'],
            'MARINE' => ['make' => 'MfgMarine', 'body' => 'BodyStyle'],
            'RV / TRAILER' => ['make' => 'MfgRvTrailer', 'body' => 'BodyStyleRvTrailer'],
            'MOTORCYCLE / ATV / POWERSPORTS' => ['make' => 'MfgMotorcycleAtv', 'body' => 'BodyStyleMotorcycleAtv'],
            'HEAVY TRUCK/EQUIPMENT' => ['make' => 'MfgHeavyTruckEquipment', 'body' => 'BodyStyleHeavyTruckEquipment'],
            'HEAVY DUTY TRAILERS' => ['make' => 'MfgHeavyDutyTrailer', 'body' => 'BodyStyleHeavyDutyTrailer'],
            'FARM EQUIPMENT' => ['make' => 'MfgFarmEquipment', 'body' => 'BodyStyleFarmEquipment'],
        ];

        $key = $map[$asset] ?? null;

        $makes = $key ? ($inv->filters->{$key['make']} ?? []) : [];
        $bodyStyles = $key ? ($inv->filters->{$key['body']} ?? []) : [];

        // -------- FORM API --------
        $formRes = Http::get(env("diskloz_base_url").'/api/inventory-form');
        $formData = json_decode($formRes->body());

        $year = $formData->Year ?? []; 
        $engine = $formData->Engine ?? []; 
        $condition = $formData->condition ?? []; 
        $transmission = $formData->Transmission ?? []; 
        $driveTrain = $formData->Drivetrain ?? [];

        return response()->json([
            'html' => view($view, compact('year', 'engine', 'condition', 'transmission', 'driveTrain'))->render(),

            'makes' => collect($makes)->map(fn($m) => [
                'id' => $m->id,
                'name' => $m->name
            ])->values(),

            'bodyStyles' => collect($bodyStyles)->map(fn($b) => [
                'id' => $b->id,
                'name' => $b->name
            ])->values(),

            'year' => collect($year)->map(fn($y) => [
                'id' => $y->id ?? $y,
                'name' => $y->name ?? $y
            ])->values(),

            'engine' => collect($engine)->map(fn($e) => [
                'id' => $e->id ?? $e,
                'name' => $e->name ?? $e
            ])->values(),

            'condition' => collect($condition)->map(fn($c) => [
                'id' => $c->id ?? $c,
                'name' => $c->name ?? $c
            ])->values(),

            'transmission' => collect($transmission)->map(fn($t) => [
                'id' => $t->id ?? $t,
                'name' => $t->name ?? $t
            ])->values(),

            'driveTrain' => collect($driveTrain)->map(fn($d) => [
                'id' => $d->id ?? $d,
                'name' => $d->name ?? $d
            ])->values(),
        ]);
    }
    

    public function addlistings()
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

        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        $pageTitle = 'Add Listing';

        /*
        =========================================
         FILTERS (MAKE + BODY STYLE)
        =========================================
        */
        $makeTypes = [];
        $bodyStyleTypes = [];
        $year = [];
        $transmission = [];
        $driveTrain = [];

        foreach ($assets as $asset) {

            $res = Http::get(env("diskloz_base_url").'/api/inventory-form', [
                'selected_asset' => $asset,
                'per_page' => 1,
            ]);

            if ($res->successful()) {

                $inv = json_decode($res->body());

                switch($asset) {
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

                //  format makes
                $makeTypes[$asset] = !empty($makes)
                    ? collect($makes)->map(fn($m) => [
                        'id' => $m->id,
                        'name' => $m->name
                    ])->sortBy('name')->values()
                    : collect();

                //  format body styles
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

        /*
        =========================================
         INVENTORY FORM DATA
        =========================================
        */
        $response = Http::get(env("diskloz_base_url").'/api/inventory-form');
        $data = json_decode($response->body());

        $array = [];
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }

        // dd($array);
        
        $year = $array['Year'] ?? [];
        $engine = $array['Engine'] ?? [];
        $transmission = $array['Transmission'] ?? [];
        $condition = $array['condition'] ?? [];
        $driveTrain = $array['Drivetrain'] ?? [];

        return view('add-listing', compact(
            'user',
            'userInfo',
            'pageTitle',
            'array',
            'year',
            'engine',
            'transmission',
            'condition',
            'assets',
            'makeTypes',
            'bodyStyleTypes',
            'driveTrain'
        ));
    }

    


    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'model' => 'nullable|string|max:255',
    //         'type' => 'nullable|string|max:255',
    //         'condition' => 'nullable|string|max:255',
    //         'stock_number' => 'nullable|string|max:255',
    //         'mileage' => 'nullable|string|max:255',
    //         'transmission' => 'nullable|string|max:255',
    //         'description' => 'nullable|string',
    //         'price' => 'nullable|string|max:255',
    //         'features' => 'nullable|array',
    //         'extra_services' => 'nullable|array',
    //         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    //         'primary_image_index' => 'required|integer|min:0',  // new validation
    //     ]);

    //     // Handle images
    //     $imageUrls = [];
    //     if ($request->hasFile('images')) {
    //         $destinationPath = public_path('listing_images');
    //         if (!file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0755, true);
    //         }

    //         foreach ($request->file('images') as $image) {
    //             $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
    //             $image->move($destinationPath, $filename);
    //             $imageUrls[] = asset('listing_images/' . $filename);
    //         }
    //     }

    //     // Ensure primary index is within range
    //     $primaryIndex = $request->primary_image_index;
    //     if (!isset($imageUrls[$primaryIndex])) {
    //         return back()->withErrors(['primary_image_index' => 'Invalid primary image selection.'])->withInput();
    //     }
    //     $primaryImageUrl = $imageUrls[$primaryIndex];

    //     // Create inventory
    //     $inventory = Inventory::create([
    //         'user_id' => auth()->id(),
    //         'title' => $request->title,
    //         'model' => $request->model,
    //         'type' => $request->type,
    //         'condition' => $request->condition,
    //         'stock_number' => $request->stock_number,
    //         'mileage' => $request->mileage,
    //         'transmission' => $request->transmission,
    //         'description' => $request->description,
    //         'features' => json_encode($request->features ?? []),
    //         'price' => $request->price,
    //         'images' => json_encode($imageUrls),
    //         'primary_image' => $primaryImageUrl,   // new field
    //     ]);

    //     // Extra services logic same as before
    //     if ($request->extra_services) {
    //         foreach ($request->extra_services as $service) {
    //             if (!empty($service['title']) || !empty($service['price'])) {
    //                 $inventory->extraServices()->create([
    //                     'title' => $service['title'] ?? '',
    //                     'price' => $service['price'] ?? null,
    //                 ]);
    //             }
    //         }
    //     }

    //     return redirect()->back()->with('success', 'Listing added successfully!');
    // }

    // public function selling(Request $request){
    //     $response = Http::get($this->baseUrl().'/api/inventory-form');
    //     $data = json_decode($response->body());
    //     $array = [];
    //     foreach ($data as $key => $value) {
    //             $array[$key] = $value;
    //     }
    //     return view('selling', ['array' => $array] );
    // }

    // public function save_inventory(Request $request)
    // {
    //     try {

    //         $http = Http::asMultipart();

    //         // 1. send normal fields
    //         foreach ($request->except('inventory_logo') as $key => $value) {
    //             if (!is_null($value)) {
    //                 $http = $http->attach(
    //                     $key,
    //                     is_array($value) ? json_encode($value) : $value
    //                 );
    //             }
    //         }

    //         // 2. user id
    //         $http = $http->attach('user_id', auth()->id());

    //         // 3. images attach (IMPORTANT FIX)
    //         if ($request->hasFile('inventory_logo')) {
    //             foreach ($request->file('inventory_logo') as $image) {
    //                 $http = $http->attach(
    //                     'images[]', // 👉 MUST match API side
    //                     file_get_contents($image->getRealPath()),
    //                     $image->getClientOriginalName()
    //                 );
    //             }
    //         }

    //         // 4. primary index
    //         if ($request->primary_image_index !== null) {
    //             $http = $http->attach('primary_image_index', $request->primary_image_index);
    //         }

    //         // 5. FINAL REQUEST (IMPORTANT)
    //         $response = $http->post(env("DISKLOZ_BASE_URL") . '/api/inventory-form-save');

    //         return redirect()->back()->with('success', 'Listing added successfully!');

    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', $e->getMessage());
    //     }
    // }


    public function save_inventory(Request $request)
    {
        Log::info('Incoming Request Data:', $request->all());

        $skip = ['inventory_logo', '_token', 'features', 'extra_services', 'inventory_logo'];
        
        // ✅ Saare fields collect karo
        $postFields = [];

        foreach ($request->except($skip) as $key => $value) {
            if (is_null($value) || is_array($value)) continue;
            $postFields[$key] = (string) $value;
        }

        $postFields['user_id'] = (string) auth()->id();

        // features[]
        foreach ((array) $request->input('features', []) as $i => $feature) {
            $postFields["features[{$i}]"] = (string) $feature;
        }

        // extra_services[]
        foreach ((array) $request->input('extra_services', []) as $i => $service) {
            if (is_array($service)) {
                foreach ($service as $key => $val) {
                    $postFields["extra_services[{$i}][{$key}]"] = (string) $val;
                }
            }
        }

        // ✅ CURLFile se images attach karo
        if ($request->hasFile('inventory_logo')) {
            foreach ($request->file('inventory_logo') as $i => $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
                    $postFields["inventory_logo[{$i}]"] = new \CURLFile(
                        $file->getRealPath(),
                        $file->getMimeType(),
                        $file->getClientOriginalName()
                    );
                }
            }
        }

        // ✅ CURL se request bhejo
        $url = env("diskloz_base_url") . '/api/inventory-form-save';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
        ]);

        $responseBody = curl_exec($ch);
        $httpStatus   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError    = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            Log::error('CURL Error: ' . $curlError);
            return back()->with('error', 'Request failed: ' . $curlError);
        }

        Log::info('API Response:', [
            'status' => $httpStatus,
            'body'   => $responseBody
        ]);

        $data = json_decode($responseBody, true);

        return back()->with('success', 'Listing added successfully!');
    }

    public function wishlist(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        
        $response = Http::get(env("diskloz_base_url").'/api/favorites?client_id='.$request->u);
        $data['favorites'] = json_decode($response->body());

        // Location map
        $dealerLocationMap = $this->dealerLocationMap();

        // Enrich favorites with location data
        $favoritesCollection = collect($data['favorites'] ?? [])->map(function ($favorite) use ($dealerLocationMap) {
            if (isset($favorite->inventory)) {
                $dealerKey = (string) ($favorite->inventory->user_id ?? $favorite->inventory->dealer_id ?? '');
                $location = $dealerLocationMap[$dealerKey] ?? [];
                
                $favorite->inventory->dealer_postal_code = $location['postal_code'] ?? null;
                $favorite->inventory->dealer_city = $location['city'] ?? null;
                $favorite->inventory->dealer_province = $location['province'] ?? null;
                $favorite->inventory->dealer_country = $location['country'] ?? null;
            }
            return $favorite;
        });

        // ✅ FIX: Store original collection before any filtering
        $originalCollection = clone $favoritesCollection;

        // Apply search filter
        $search = $request->get('search');
        if (!empty($search)) {
            $favoritesCollection = $favoritesCollection->filter(function ($favorite) use ($search) {
                if (!isset($favorite->inventory)) {
                    return false;
                }
                
                $inventory = $favorite->inventory;
                $searchLower = strtolower($search);
                
                return str_contains(strtolower($inventory->mfg_auto ?? ''), $searchLower) ||
                    str_contains(strtolower($inventory->model ?? ''), $searchLower) ||
                    str_contains(strtolower($inventory->year ?? ''), $searchLower) ||
                    str_contains(strtolower($inventory->trim ?? ''), $searchLower) ||
                    str_contains(strtolower($inventory->mileage ?? ''), $searchLower) ||
                    str_contains(strtolower($inventory->body_style ?? ''), $searchLower) ||
                    str_contains(strtolower($inventory->transmission ?? ''), $searchLower) ||
                    str_contains(strtolower($inventory->engine ?? ''), $searchLower);
            })->values();
        }
        
        // Apply sorting
        $sort = $request->get('sort', 'newest');
        
        switch ($sort) {
            case 'price_asc':
                $favoritesCollection = $favoritesCollection->sortBy(function ($favorite) {
                    return $favorite->inventory->price_retail_date ?? 0;
                })->values();
                break;
                
            case 'price_desc':
                $favoritesCollection = $favoritesCollection->sortByDesc(function ($favorite) {
                    return $favorite->inventory->price_retail_date ?? 0;
                })->values();
                break;
                
            case 'newest':
                $favoritesCollection = $favoritesCollection->sortByDesc(function ($favorite) {
                    return $favorite->inventory->id ?? 0;
                })->values();
                break;
                
            case 'popularity':
                $favoritesCollection = $favoritesCollection->sortByDesc(function ($favorite) {
                    return $favorite->inventory->rating ?? 0;
                })->values();
                break;
                
            default:
                $favoritesCollection = $favoritesCollection->sortByDesc(function ($favorite) {
                    return $favorite->inventory->id ?? 0;
                })->values();
                break;
        }

        $total_favorites = $favoritesCollection->count();

        // Pagination variables
        $perPage = 3;
        $currentPage = $request->get('page', 1);

        $favorites = new LengthAwarePaginator(
            $favoritesCollection->forPage($currentPage, $perPage),
            $total_favorites,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // For your partial.pagination
        $last_page = $favorites->lastPage();
        $current_page = $favorites->currentPage();
        $currentSort = $request->get('sort', 'newest');
        $searchTerm = $request->get('search', '');

        // ✅ FIX: Use ORIGINAL collection, not filtered one
        $searched_vehicle = $originalCollection->isNotEmpty() 
            ? $originalCollection->first()->inventory ?? null 
            : null;
        
        // ✅ FIX: Get first vehicle's dealer and product IDs for the modal
        $firstFavorite = $originalCollection->isNotEmpty() ? $originalCollection->first() : null;
        
        $pageTitle = 'My Wishlist';
        $disklozBaseUrl = $this->disklozBaseUrl();
        
        return view('wishlist', compact(
            'user', 
            'userInfo', 
            'favorites', 
            'total_favorites', 
            'searched_vehicle',
            'firstFavorite',  // ✅ Add this for modal
            'pageTitle', 
            'disklozBaseUrl',
            'last_page',
            'current_page',
            'currentSort',
            'searchTerm'
        ));
    }
    
}