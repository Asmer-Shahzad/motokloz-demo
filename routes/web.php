<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DealerProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DealerNetworkController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;


/*
|--------------------------------------------------------------------------
| Public Routes (sab access kar sakte)
|--------------------------------------------------------------------------
*/



Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    // Forgot Password Routes
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

    // Reset Password Routes
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'register'])->name('signup.post');
});


/*
|--------------------------------------------------------------------------
| Protected Routes (login required)
|--------------------------------------------------------------------------
*/
Route::get('/dealer/{id}', [DealerProfileController::class, 'dealer_inventory'])->name('dealer_inventory');
Route::post('/add_like', [InventoryController::class, 'add_like']);
Route::post('/remove_like', [InventoryController::class, 'remove_like']);
Route::get('/pdf/disklozer/{id}', [InventoryController::class, 'inventoryDisklozer1']);
Route::get('/', [HomeController::class, 'home'])->name('home');
// Route::get('/car-listing', [InventoryController::class, 'inventory'])->name('car.listing');
Route::get('/car-listing', [SearchController::class, 'search_inventory'])->name('search_inventory');
Route::get('/car-details/{id}', [InventoryController::class, 'inventory_product_details'])->name('inventory_product_details');
Route::get('/dealer-profile/{name}/{id}', [DealerProfileController::class, 'dealer_inventory_details'])->name('dealer_inventory_details');
Route::get('/dealer-network', [DealerNetworkController::class, 'fetch_dealers'])->name('fetch_dealers');
Route::post('/dealer-application/submit', [DealerNetworkController::class, 'dealer_application_submit'])->name('dealer.application.submit');
Route::post('/support/submit', [DealerNetworkController::class, 'support_submti'])->name('support.application.submit');
Route::get('/coming-soon', [HomeController::class, 'comingsoon'])->name('comingsoon');
Route::get('/buy/step-1', [HomeController::class, 'buyFlowStep1'])->name('buy.step1');
Route::get('/buy/step-2', [HomeController::class, 'buyFlowStep2'])->name('buy.step2');
Route::get('/buy/step-3', [HomeController::class, 'buyFlowStep3'])->name('buy.step3');
Route::get('/buy/step-4', [HomeController::class, 'buyFlowStep4'])->name('buy.step4');
Route::get('/buy/step-5', [HomeController::class, 'buyFlowStep5'])->name('buy.step5');
Route::get('/buy/step-6', [HomeController::class, 'buyFlowStep6'])->name('buy.step6');
Route::post('/contact-mail', [SearchController::class, 'contactMail'])->name('contact.mail');
Route::post('/test-drive-mail', [SearchController::class, 'testDriveMail']);
Route::post('/offer-mail', [SearchController::class, 'offerMail']);
Route::post('/motokloz-test-drive-mail', [SearchController::class, 'MotokloztestDriveMail']);

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
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/unread-count', [ChatController::class, 'unreadCount'])->name('chat.unread.count');
    Route::get('/chat/conversations-unread', [ChatController::class, 'conversationsUnread'])->name('chat.conversations.unread');
    Route::post('/chat/start', [ChatController::class, 'startOrGet'])->name('chat.start');
    Route::get('/chat/{clientId}/{dealerId}/{inventoryId}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{clientId}/{dealerId}/{inventoryId}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/{clientId}/{dealerId}/{inventoryId}/poll', [ChatController::class, 'pollMessages'])->name('chat.poll');
    Route::post('/chat/{clientId}/{dealerId}/{inventoryId}/read', [ChatController::class, 'markRead'])->name('chat.read');
    Route::get('/chat/{clientId}/{dealerId}/{inventoryId}/data', [ChatController::class, 'showJson'])->name('chat.show.json');
    Route::get('/agent-settings', [HomeController::class, 'agentsettings'])->name('agent.settings');
    Route::get('/agent-dashboard', [HomeController::class, 'agentdashboard'])->name('agent.dashboard');
    Route::get('/wishlist', [ListingController::class, 'wishlist'])->name('wishlist');
    
    Route::get('/add-listing', [ListingController::class, 'addlistings'])->name('add.listings');
    Route::post('/add-listing', [ListingController::class, 'save_inventory'])->name('store.save_inventory');
    Route::get('/load-asset-form', [ListingController::class, 'loadAssetForm'])->name('load.asset.form');
    Route::get('/listings', [ListingController::class, 'listingsIndex'])->name('listings');
    Route::get('/listing-car-details/{id}', [ListingController::class, 'user_inventory_product_details'])->name('user_inventory_product_details');
    Route::get('/account-setting', [HomeController::class, 'accountsettings'])->name('account.settings');
    Route::get('/agent-settings', [ProfileController::class, 'index'])->name('profile.settings');
    Route::put('/agent-settings', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/agent-settings/contact', [ProfileController::class, 'updateContact'])->name('profile.contact.update');
    Route::put('/agent-settings/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/agent-settings/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::delete('/agent-settings/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
    Route::delete('/listings/{id}', [HomeController::class, 'deleteListing'])->name('delete.listing');
});

// Guest-accessible AJAX routes (auth modal)
Route::post('/auth/login-ajax', [AuthController::class, 'loginAjax'])->name('auth.login.ajax');
Route::post('/auth/register-ajax', [AuthController::class, 'registerAjax'])->name('auth.register.ajax');

// OAuth routes (Google, Facebook)
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirectToProvider'])
    ->where('provider', 'google|facebook')
    ->name('auth.oauth.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback'])
    ->where('provider', 'google|facebook')
    ->name('auth.oauth.callback');

// Store chat intent in session (guest accessible)
Route::post('/chat/set-intent', function (Illuminate\Http\Request $request) {
    session(['intended_chat_url' => $request->input('url')]);
    return response()->json(['ok' => true]);
})->name('chat.set.intent');