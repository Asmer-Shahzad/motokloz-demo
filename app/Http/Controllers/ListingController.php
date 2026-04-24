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
use App\Http\Controllers\Concerns\EnrichesVehicleLocation;


class ListingController extends Controller
{
    use EnrichesVehicleLocation;

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

    public function listingsIndex(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        $userLocation = [];
        if (auth()->check()) {
            $info = auth()->user()->information;
            if ($info) {
                $userLocation = [
                    'postalCode'       => $info->postalCode       ?? null,
                    'city'             => $info->city             ?? null,
                    'country'          => $info->country          ?? null,
                    'complete_address' => $info->complete_address ?? null,
                ];
            }
        }

        // ✅ Diskloz API se Motokloz inventory fetch karo
        try {
            $inventoryResponse = Http::get($this->disklozBaseUrl() . '/api/search_motokloz_inventory', [
                'client_id' => auth()->id(),
            ]);

            $allListings = $inventoryResponse->successful()
                ? collect($inventoryResponse->json()['data'] ?? [])
                : collect();
        } catch (\Exception $e) {
            \Log::error('Motokloz listings fetch error: ' . $e->getMessage());
            $allListings = collect();
        }

        // ✅ Search filter
        $search = $request->get('search');
        if (!empty($search)) {
            $allListings = $allListings->filter(function ($item) use ($search) {
                $item = (object) $item;
                return str_contains(strtolower($item->title        ?? ''), strtolower($search))
                    || str_contains(strtolower($item->model        ?? ''), strtolower($search))
                    || str_contains(strtolower($item->type         ?? ''), strtolower($search))
                    || str_contains(strtolower($item->condition    ?? ''), strtolower($search))
                    || str_contains(strtolower($item->stock_number ?? ''), strtolower($search))
                    || str_contains(strtolower($item->transmission ?? ''), strtolower($search))
                    || str_contains(strtolower($item->description  ?? ''), strtolower($search))
                    || str_contains(strtolower($item->features     ?? ''), strtolower($search))
                    || str_contains((string)($item->price          ?? ''), $search);
            })->values();
        }

        // ✅ Sorting
        $sort = $request->get('sort', 'newest');

        $allListings = match ($sort) {
            'price_asc'  => $allListings->sortBy('price')->values(),
            'price_desc' => $allListings->sortByDesc('price')->values(),
            'oldest'     => $allListings->sortBy('created_at')->values(),
            default      => $allListings->sortByDesc('created_at')->values(),
        };

        // ✅ Location enrich karo
        $allListings = $allListings->map(function ($item) use ($userLocation) {
            $item = (object) $item;
            $item->dealer_postal_code      = $userLocation['postalCode']       ?? null;
            $item->dealer_city             = $userLocation['city']             ?? null;
            $item->dealer_country          = $userLocation['country']          ?? null;
            $item->dealer_complete_address = $userLocation['complete_address'] ?? null;

            // ✅ features null na ho
            $item->features  = $item->features  ?? null;
            $item->title     = $item->title     ?? '';
            $item->mileage   = $item->mileage   ?? null;
            $item->price     = $item->price     ?? 0;
            $item->primary_image = $item->primary_image ?? null;

            return $item;
        });

        // ✅ Pagination
        $total_listings = $allListings->count();
        $perPage        = 6;
        $currentPage    = $request->get('page', 1);

        $disklozBaseUrl = $this->disklozBaseUrl();

        $listings = new LengthAwarePaginator(
            $allListings->forPage($currentPage, $perPage),
            $total_listings,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $last_page    = $listings->lastPage();
        $current_page = $listings->currentPage();
        $pageTitle    = 'Listings';
        $currentSort  = $request->get('sort', 'newest');
        $searchTerm   = $request->get('search', '');

        return view('listings', compact(
            'user',
            'userInfo',
            'listings',
            'pageTitle',
            'last_page',
            'current_page',
            'currentSort',
            'searchTerm',
            'disklozBaseUrl' // ✅ add this
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

        return view('listing-car-details', compact('searched_vehicle', 'user', 'userInfo'));
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
        $res = Http::get($this->disklozBaseUrl() . '/api/search_inventory', [
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
        $formRes = Http::get($this->disklozBaseUrl() . '/api/inventory-form');
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

            $res = Http::get($this->disklozBaseUrl() . '/api/inventory-form', [
                'selected_asset' => $asset,
                'per_page' => 1,
            ]);

            if ($res->successful()) {

                $inv = json_decode($res->body());

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
        $response = Http::get($this->disklozBaseUrl() . '/api/inventory-form');
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

    public function save_inventory(Request $request)
    {
        Log::info('Incoming Request Data:', $request->all());

        $skip = ['inventory_logo', '_token', 'features', 'extra_services'];

        $postFields = [];

        // ✅ Saare regular fields bhejo (NULL bhi)
        foreach ($request->except($skip) as $key => $value) {
            if (is_array($value)) continue;
            $postFields[$key] = (string) ($value ?? '');
        }

        // ✅ Fixed fields
        $postFields['user_id']          = (string) auth()->id();
        $postFields['client_id']        = (string) auth()->id();
        $postFields['user_role']        = 'MOTOKLOZ';
        $postFields['share_indicators'] = 'SHARE TO MOTOKLOZ';
        $postFields['status']           = '1';

        // ✅ Features → interior ke naam se bhejo
        $features = (array) $request->input('features', []);
        foreach ($features as $i => $feature) {
            $postFields["interior[{$i}]"] = (string) $feature;
        }

        // ✅ Extra Services
        $extraServices = $request->input('extra_services', []);
        $validServices = [];
        $validIndex = 0;

        if (is_array($extraServices)) {
            foreach ($extraServices as $service) {
                if (isset($service['title']) && !empty(trim($service['title']))) {
                    $validServices[] = [
                        'title' => trim($service['title']),
                        'price' => $service['price'] ?? null
                    ];
                    $postFields["extra_services[{$validIndex}][title]"] = trim($service['title']);
                    $postFields["extra_services[{$validIndex}][price]"] = (string) ($service['price'] ?? '');
                    $validIndex++;
                }
            }
        }

        if (!empty($validServices)) {
            $postFields['extras'] = implode(',', array_column($validServices, 'title'));
        }

        Log::info('Extra Services:', $validServices);
        Log::info('Post Fields being sent:', array_filter($postFields, fn($v) => !($v instanceof \CURLFile)));

        // ✅ Images
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

        // ✅ CURL
        $url = env("diskloz_base_url") . '/api/inventory-form-save';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

        $responseBody = curl_exec($ch);
        $httpStatus   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError    = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            Log::error('CURL Error: ' . $curlError);
            return back()->with('error', 'Request failed: ' . $curlError)->withInput();
        }

        Log::info('API Response:', ['status' => $httpStatus, 'body' => $responseBody]);

        $data = json_decode($responseBody, true);

        if ($httpStatus === 200 && isset($data['status']) && $data['status'] === true) {
            return back()->with('success', 'Listing added successfully!');
        } else {
            $errorMsg = $data['message'] ?? $data['error'] ?? 'Failed to save inventory';
            return back()->with('error', $errorMsg)->withInput();
        }
    }
    public function wishlist(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        $response = Http::get($this->disklozBaseUrl() . '/api/favorites?client_id=' . $request->u);
        $data['favorites'] = json_decode($response->body());

        // Location map
        $dealerLocationMap   = $this->dealerLocationMap();
        $motoklozLocationMap = $this->motoklozUserLocationMap();

        // Enrich favorites with location data
        $favoritesCollection = collect($data['favorites'] ?? [])->map(function ($favorite) use ($dealerLocationMap, $motoklozLocationMap) {
            if (isset($favorite->inventory)) {
                $favorite->inventory = $this->enrichVehicleLocation(
                    (object) $favorite->inventory,
                    $motoklozLocationMap,
                    $dealerLocationMap
                );

                // ✅ Ensure source is set
                if (!isset($favorite->inventory->source)) {
                    $favorite->inventory->source = $favorite->inventory->source ?? 'other';
                }

                // ✅ Agar source Motokloz hai toh user ki email lo
                if ($favorite->inventory->source === 'Motokloz') {
                    $userId = $favorite->inventory->user_id ?? $favorite->inventory->client_id ?? null;
                    $motoklozUser = \App\Models\User::find($userId);
                    $favorite->inventory->dealer_email = $motoklozUser->email ?? 'info@motokloz.com';
                }
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
                $searchLower = strtolower(trim($search));

                // Convert entire inventory to JSON string and search in it
                // This catches any field name regardless of API changes
                $inventoryJson = strtolower(json_encode($inventory));

                return str_contains($inventoryJson, $searchLower);
            })->values();
        }

        // Apply sorting
        $sort = $request->get('sort', 'newest');

        switch ($sort) {
            case 'price_asc':
                $favoritesCollection = $favoritesCollection->sortBy(function ($favorite) {
                    return $favorite->inventory->disclosed_price ?? 0;
                })->values();
                break;

            case 'price_desc':
                $favoritesCollection = $favoritesCollection->sortByDesc(function ($favorite) {
                    return $favorite->inventory->disclosed_price ?? 0;
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
            'firstFavorite',
            'pageTitle',
            'disklozBaseUrl',
            'last_page',
            'current_page',
            'currentSort',
            'searchTerm'
        ));
    }
}
