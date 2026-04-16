<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use App\Models\UserInformation;
use App\Http\Controllers\Concerns\EnrichesVehicleLocation;

class HomeController extends Controller
{
    use EnrichesVehicleLocation;

    public function home()
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

        $assetCounts = [];
        $allVehicles = collect();
        $makeTypes = []; // will hold grouped makes
        $dealerLocationMap  = $this->dealerLocationMap();
        $motoklozLocationMap = $this->motoklozUserLocationMap();

        foreach ($assets as $asset) {
            $response = Http::get($this->disklozBaseUrl() . '/api/search_inventory', [
                'selected_asset' => $asset,
                'per_page' => 4,
            ]);

            if ($response->successful()) {
                $inventory = json_decode($response->body());

                // Count vehicles per asset type
                $assetCounts[$asset] = $inventory->inventory->total ?? 0;

                // Merge latest vehicles
                if (!empty($inventory->inventory->data)) {
                    $enrichedVehicles = collect($inventory->inventory->data)->map(function ($vehicle) use ($dealerLocationMap, $motoklozLocationMap) {
                        return $this->enrichVehicleLocation($vehicle, $motoklozLocationMap, $dealerLocationMap);
                    });
                    $allVehicles = $allVehicles->merge($enrichedVehicles);
                }

                // Merge makes grouped by type
                if (!empty($inventory->filters)) {
                    // Convert stdClass to collection
                    $filters = collect($inventory->filters);

                    // Use only MfgAuto for this asset
                    if (!empty($filters->MfgAuto)) {
                        $makeTypes[$asset] = collect($filters->MfgAuto)
                            ->map(function ($m) {
                                return ['id' => $m->id, 'name' => $m->name];
                            })
                            ->sortBy('name')
                            ->values();
                    } else {
                        $makeTypes[$asset] = collect(); // empty collection if none
                    }
                }
            }
        }

        // Get latest 4 vehicles overall
        $latestVehicles = $allVehicles
            ->sortByDesc('created_at')
            ->take(4)
            ->values();

        return view('home', [
            'user' => $user,
            'userInfo' => $userInfo,
            'pageTitle' => 'Home',
            'assetCounts' => $assetCounts,
            'assetData' => $latestVehicles,
            'assets' => $assets,
            'makeTypes' => $makeTypes,
            'disklozBaseUrl' => $this->disklozBaseUrl(),
        ]);
    }

    public function buyFlowStep1()
    {
        return view('buy-flow-step-1', ['pageTitle' => 'Step 1']);
    }

    public function buyFlowStep2()
    {
        return view('buy-flow-step-2', ['pageTitle' => 'Step 2']);
    }

    public function buyFlowStep3()
    {
        return view('buy-flow-step-3', ['pageTitle' => 'Step 3']);
    }

    public function buyFlowStep4()
    {
        return view('buy-flow-step-4', ['pageTitle' => 'Step 4']);
    }

    public function buyFlowStep5()
    {
        return view('buy-flow-step-5', ['pageTitle' => 'Step 5']);
    }

    public function buyFlowStep6()
    {
        return view('buy-flow-step-6', ['pageTitle' => 'Step 6']);
    }

    public function comingsoon()
    {
        return view('coming-soon', ['pageTitle' => 'Coming Soon']);
    }

    public function dealerprofile()
    {
        return view('dealer-profile', ['pageTitle' => 'Dealer Profile']);
    }

    public function dealernetwork()
    {
        return view('dealer-network', ['pageTitle' => 'Dealer Network']);
    }

    public function chat()
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();


        return view('chat', ['pageTitle' => 'Chat', 'user' => $user, 'userInfo' => $userInfo]);
    }

    public function carlisting()
    {
        return view('car-listing', ['pageTitle' => 'Car Listing']);
    }

    public function cardetails()
    {
        return view('car-details', ['pageTitle' => 'Car Details']);
    }

    public function agentdashboard(Request $request)
    {
        $user     = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        $sort    = $request->get('sort', 'newest');
        $perPage = 4;

        // ✅ Diskloz API se Motokloz inventory fetch karo
        try {
            $inventoryResponse = Http::get(env("DISKLOZ_BASE_URL") . '/api/search_motokloz_inventory', [
                'client_id' => auth()->id(),
            ]);

            $allListings = $inventoryResponse->successful()
                ? collect($inventoryResponse->json()['data'] ?? [])
                : collect();

        } catch (\Exception $e) {
            \Log::error('Motokloz dashboard fetch error: ' . $e->getMessage());
            $allListings = collect();
        }

        // ✅ Sorting
        $allListings = match($sort) {
            'price_asc'  => $allListings->sortBy('price_retail_date')->values(),
            'price_desc' => $allListings->sortByDesc('price_retail_date')->values(),
            'oldest'     => $allListings->sortBy('created_at')->values(),
            default      => $allListings->sortByDesc('created_at')->values(),
        };

        // ✅ Manual pagination
        $total        = $allListings->count();
        $currentPage  = $request->get('page', 1);

        $disklozBaseUrl = env("diskloz_base_url");

        $listings = new LengthAwarePaginator(
            $allListings->forPage($currentPage, $perPage),
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $last_page    = $listings->lastPage();
        $current_page = $listings->currentPage();
        $pageTitle    = 'Dashboard';

        
        return view('agent-dashboard', compact(
            'user',
            'listings',
            'userInfo',
            'pageTitle',
            'last_page',
            'current_page',
            'sort',
            'disklozBaseUrl' 
        ));
    }

    // Add delete method in controller
    public function deleteListing($id)
    {
        try {
            $listing = Inventory::where('user_id', auth()->id())
                ->where('id', $id)
                ->first();

            if (!$listing) {
                return response()->json(['success' => false, 'message' => 'Listing not found'], 404);
            }

            // Delete images from server
            if ($listing->images) {
                $images = json_decode($listing->images, true);
                foreach ($images as $image) {
                    $imagePath = public_path(parse_url($image, PHP_URL_PATH));
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }

            // Delete primary image
            if ($listing->primary_image) {
                $primaryImagePath = public_path(parse_url($listing->primary_image, PHP_URL_PATH));
                if (file_exists($primaryImagePath)) {
                    unlink($primaryImagePath);
                }
            }

            // Delete extra services
            $listing->extraServices()->delete();

            // Delete listing
            $listing->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error deleting listing: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error deleting listing'], 500);
        }
    }

    public function dealer()
    {
        return view('dealer', ['pageTitle' => 'Dealer']);
    }

    public function accountsettings()
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        $pageTitle = 'Account Settings';

        return view('account-setting', compact('user', 'userInfo', 'pageTitle'));
    }

    public function pageNotFound()
    {
        $pageTitle = 'Page Not Found';
        return response()->view('errors.404', compact('pageTitle'), 404);
    }
}
