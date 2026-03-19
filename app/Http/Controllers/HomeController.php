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

    foreach ($assets as $asset) {

        $response = Http::get(env("diskloz_base_url").'/api/search_inventory', [
            'selected_asset' => $asset,
            'page' => 1
        ]);

        $inventory = json_decode($response->body());

        // count backend me preserve
        $assetCounts[$asset] = $inventory->total ?? 0;

        if (!empty($inventory->data)) {
            $allVehicles = $allVehicles->merge(collect($inventory->data));
        }
    }

    // 🔥 overall latest 4 vehicles only
    $latestVehicles = $allVehicles
        ->sortByDesc('created_at') // ya id agar created_at nahi hai
        ->take(4)
        ->values();

    return view('home', [
        'pageTitle' => 'Home',
        'assetCounts' => $assetCounts, // backend use ke liye
        'assetData' => $latestVehicles // Blade me sirf ye use hoga
    ]);
}


    public function wishlist()
    {
        return view('wishlist', ['pageTitle' => 'Wishlist']);
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