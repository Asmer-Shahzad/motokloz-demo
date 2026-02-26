<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist');
    Route::get('/listings', [HomeController::class, 'listings'])->name('listings');

    Route::get('/dealer-profile', [HomeController::class, 'dealerprofile'])->name('dealer.profile');
    Route::get('/dealer-network', [HomeController::class, 'dealernetwork'])->name('dealer.network');

    Route::get('/chat', [HomeController::class, 'chat'])->name('chat');

    Route::get('/car-listing', [HomeController::class, 'carlisting'])->name('car.listing');
    Route::get('/car-details', [HomeController::class, 'cardetails'])->name('car.details');

    Route::get('/agent-settings', [HomeController::class, 'agentsettings'])->name('agent.settings');
    Route::get('/agent-dashboard', [HomeController::class, 'agentdashboard'])->name('agent.dashboard');

    Route::get('/add-listings', [HomeController::class, 'addlistings'])->name('add.listings');

    Route::get('/account-setting', [HomeController::class, 'accountsettings'])->name('account.settings');
});