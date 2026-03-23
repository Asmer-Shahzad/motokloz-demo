<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DealerProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DealerNetworkController;


/*
|--------------------------------------------------------------------------
| Public Routes (sab access kar sakte)
|--------------------------------------------------------------------------
*/



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'register'])->name('signup.post');
});


/*
|--------------------------------------------------------------------------
| Protected Routes (login required)
|--------------------------------------------------------------------------
*/
Route::get('/dealer/{id}', [DealerProfileController::class, 'dealer_inventory'])->name('dealer_inventory');
Route::get('/', [HomeController::class, 'home'])->name('home');
// Route::get('/car-listing', [InventoryController::class, 'inventory'])->name('car.listing');
Route::get('/car-listing', [SearchController::class, 'search_inventory'])->name('search_inventory');
Route::get('/car-details/{id}', [InventoryController::class, 'inventory_product_details'])->name('inventory_product_details');
Route::get('/dealer-profile/{id}', [DealerProfileController::class, 'dealer_inventory_details'])->name('dealer_inventory_details');
Route::get('/dealer-network', [DealerNetworkController::class, 'fetch_dealers'])->name('fetch_dealers');
Route::get('/coming-soon', [HomeController::class, 'comingsoon'])->name('comingsoon');
Route::get('/buy/step-1', [HomeController::class, 'buyFlowStep1'])->name('buy.step1');
Route::get('/buy/step-2', [HomeController::class, 'buyFlowStep2'])->name('buy.step2');
Route::get('/buy/step-3', [HomeController::class, 'buyFlowStep3'])->name('buy.step3');
Route::get('/buy/step-4', [HomeController::class, 'buyFlowStep4'])->name('buy.step4');
Route::get('/buy/step-5', [HomeController::class, 'buyFlowStep5'])->name('buy.step5');
Route::get('/buy/step-6', [HomeController::class, 'buyFlowStep6'])->name('buy.step6');
Route::get('/sell', function () {

    if (Auth::check()) {
        // user logged in
        return redirect()->route('add.listings');
    }

    // agar login nahi hai to login page
    return redirect()->route('login');
})->name('sell');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist');
    Route::get('/chat', [HomeController::class, 'chat'])->name('chat');
    Route::get('/agent-settings', [HomeController::class, 'agentsettings'])->name('agent.settings');
    Route::get('/agent-dashboard', [HomeController::class, 'agentdashboard'])->name('agent.dashboard');
    Route::get('/add-listings', [HomeController::class, 'addlistings'])->name('add.listings');
    Route::get('/account-setting', [HomeController::class, 'accountsettings'])->name('account.settings');
    Route::get('/listings', [HomeController::class, 'listings'])->name('listings');
});