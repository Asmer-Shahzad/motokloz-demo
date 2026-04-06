<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
class HomeController extends Controller
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
        $dealerLocationMap = $this->dealerLocationMap();

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
                    $enrichedVehicles = collect($inventory->inventory->data)->map(function ($vehicle) use ($dealerLocationMap) {
                        $dealerKey = (string) ($vehicle->user_id ?? $vehicle->dealer_id ?? '');
                        $location = $dealerLocationMap[$dealerKey] ?? [];
                        $vehicle->dealer_postal_code = $location['postal_code'] ?? null;
                        $vehicle->dealer_city = $location['city'] ?? null;
                        $vehicle->dealer_province = $location['province'] ?? null;
                        $vehicle->dealer_country = $location['country'] ?? null;
                        return $vehicle;
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
                            ->map(function($m) {
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

    public function agentdashboard()
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        $listings = Inventory::where('user_id', auth()->id())
                    ->with('extraServices')
                    ->latest()
                    ->get();
        $pageTitle = 'Dashboard';
        
        return view('agent-dashboard', compact('user', 'listings', 'userInfo', 'pageTitle'));
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
}