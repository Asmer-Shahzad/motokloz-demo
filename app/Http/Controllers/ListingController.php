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


    public function listingsIndex()
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        $listings = Inventory::where('user_id', auth()->id())
                    ->with('extraServices')
                    ->latest()
                    ->paginate(9);
        $pageTitle = 'Listings';

        return view('listings', compact('user', 'userInfo', 'listings', 'pageTitle'));
    }

    public function user_inventory_product_details(Request $request, $id)
    {
        $searched_vehicle = Inventory::where('user_id', auth()->id())
            ->with('extraServices')
            ->where('id', $id)
            ->first(); // 👈 single record

        if (!$searched_vehicle) {
            abort(404);
        }

        return view('listing-car-details', compact('searched_vehicle'));
    }

    public function addlistings()
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        $pageTitle = 'Add Listing';
        
        return view('add-listing', compact('user', 'userInfo', 'pageTitle'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'condition' => 'nullable|string|max:255',
            'stock_number' => 'nullable|string|max:255',
            'mileage' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'extra_services' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'primary_image_index' => 'required|integer|min:0',  // new validation
        ]);

        // Handle images
        $imageUrls = [];
        if ($request->hasFile('images')) {
            $destinationPath = public_path('listing_images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $filename);
                $imageUrls[] = asset('listing_images/' . $filename);
            }
        }

        // Ensure primary index is within range
        $primaryIndex = $request->primary_image_index;
        if (!isset($imageUrls[$primaryIndex])) {
            return back()->withErrors(['primary_image_index' => 'Invalid primary image selection.'])->withInput();
        }
        $primaryImageUrl = $imageUrls[$primaryIndex];

        // Create inventory
        $inventory = Inventory::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'model' => $request->model,
            'type' => $request->type,
            'condition' => $request->condition,
            'stock_number' => $request->stock_number,
            'mileage' => $request->mileage,
            'transmission' => $request->transmission,
            'description' => $request->description,
            'features' => json_encode($request->features ?? []),
            'price' => $request->price,
            'images' => json_encode($imageUrls),
            'primary_image' => $primaryImageUrl,   // new field
        ]);

        // Extra services logic same as before
        if ($request->extra_services) {
            foreach ($request->extra_services as $service) {
                if (!empty($service['title']) || !empty($service['price'])) {
                    $inventory->extraServices()->create([
                        'title' => $service['title'] ?? '',
                        'price' => $service['price'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Listing added successfully!');
    }

    public function wishlist(Request $request)
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();
        
        $response = Http::get(env("diskloz_base_url").'/api/favorites?client_id='.$request->u);
        $data['favorites'] = json_decode($response->body());

        // ✅ Location map
        $dealerLocationMap = $this->dealerLocationMap();

        // ✅ Enrich favorites with location data
        $favorites = collect($data['favorites'] ?? [])->map(function ($favorite) use ($dealerLocationMap) {
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
        
        $total_favorites = $favorites->count();
        $searched_vehicle = $favorites->isNotEmpty() ? $favorites->first()->inventory ?? null : null;
        $pageTitle = 'My Wishlist';
        $disklozBaseUrl = $this->disklozBaseUrl();
        
        return view('wishlist', compact('user', 'userInfo', 'favorites', 'total_favorites', 'searched_vehicle', 'pageTitle', 'disklozBaseUrl'));
    }
    
}