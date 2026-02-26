<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home', ['pageTitle' => 'Home']);
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
        return view('agent-setting', ['pageTitle' => 'Agent Settings']);
    }

    public function agentdashboard()
    {
        return view('agent-dashboard', ['pageTitle' => 'Agent Dashboard']);
    }

    public function addlistings()
    {
        return view('add-listing', ['pageTitle' => 'Add Listing']);
    }

    public function accountsettings()
    {
        return view('account-setting', ['pageTitle' => 'Account Settings']);
    }
}