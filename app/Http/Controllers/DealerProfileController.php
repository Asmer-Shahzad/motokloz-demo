<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Pagination\LengthAwarePaginator; // ✅ ADD THIS

class DealerProfileController extends Controller
{
    public function dealer_inventory_details($id)
    {
        $response = Http::get(env("diskloz_base_url") . '/api/dealer_by_id/' . $id);

        if (!$response->successful()) {
            abort(404, 'Dealer not found');
        }

        $data = $response->json();

        if (!($data['status'] ?? false)) {
            abort(404, 'Dealer not found');
        }

        $dealer = (object) $data['data'];

        // total inventory count
        $total_inventory = count($dealer->inventory ?? []);

        // sirf 4 vehicles show karne ke liye
        $inventory = collect($dealer->inventory ?? [])
                        ->take(4)
                        ->map(fn($item) => (object) $item);

        return view('dealer-profile', [
            'dealer'           => $dealer,
            'contact'          => $dealer->phone_no ?? null,
            'inventory'        => $inventory,
            'total_inventory'  => $total_inventory
        ]);
    }

    public function dealer_inventory($id)
    {
        $response = Http::get(env("diskloz_base_url") . '/api/dealer_by_id/' . $id);

        if (!$response->successful()) {
            abort(404, 'Dealer not found');
        }

        $data = $response->json();

        if (!($data['status'] ?? false)) {
            abort(404, 'Dealer not found');
        }

        $dealer = (object) $data['data'];

        // Inventory collection
        $inventoryCollection = collect($dealer->inventory ?? []);

        // Pagination settings
        $perPage = 9;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $inventoryCollection
            ->slice(($currentPage - 1) * $perPage, $perPage)
            ->map(fn($item) => (object) $item)
            ->values();

        $inventory = new LengthAwarePaginator(
            $currentItems,
            $inventoryCollection->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('dealer', [
            'dealer' => $dealer,
            'inventory' => $inventory
        ]);
    }
}
