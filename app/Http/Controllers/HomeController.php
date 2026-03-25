<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;

class HomeController extends Controller
{
    public function home()
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

        $assetCounts = [];
        $allVehicles = collect();
        $makeTypes = []; // will hold grouped makes

        foreach ($assets as $asset) {
            $response = Http::get(env("diskloz_base_url").'/api/search_inventory', [
                'selected_asset' => $asset,
                'per_page' => 4,
            ]);

            if ($response->successful()) {
                $inventory = json_decode($response->body());

                // Count vehicles per asset type
                $assetCounts[$asset] = $inventory->inventory->total ?? 0;

                // Merge latest vehicles
                if (!empty($inventory->inventory->data)) {
                    $allVehicles = $allVehicles->merge(collect($inventory->inventory->data));
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
            'pageTitle' => 'Home',
            'assetCounts' => $assetCounts,
            'assetData' => $latestVehicles,
            'assets' => $assets,
            'makeTypes' => $makeTypes, // send grouped makes to frontend
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

    public function wishlist()
    {
        return view('wishlist', ['pageTitle' => 'Wishlist']);
    }

    public function comingsoon()
    {
        return view('coming-soon', ['pageTitle' => 'Coming Soon']);
    }

    public function listings()
    {
        return view('listings', ['pageTitle' => 'Listings']);
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
        return view('chat', ['pageTitle' => 'Chat']);
    }

    public function carlisting()
    {
        return view('car-listing', ['pageTitle' => 'Car Listing']);
    }

    public function cardetails()
    {
        return view('car-details', ['pageTitle' => 'Car Details']);
    }

    public function agentsettings()
    {
        return view('agent-setting', ['pageTitle' => 'My Profile']);
    }

    public function agentdashboard()
    {
        return view('agent-dashboard', ['pageTitle' => ' Dashboard']);
    }

    public function addlistings()
    {
        return view('add-listing', ['pageTitle' => 'Add Listing']);
    }
    public function dealer()
    {
        return view('dealer', ['pageTitle' => 'Dealer']);
    }

    public function accountsettings()
    {
        return view('account-setting', ['pageTitle' => 'Account Settings']);
    }
}