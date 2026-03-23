<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class DealerNetworkController extends Controller
{
    /**
     * Fetch dealers from external API and return with inventory count + pagination
     */
    public function fetch_dealers(Request $request)
    {
        try {
            $page = $request->input('page', 1);
            $perPage = 15;

            // External API call
            $response = Http::get(env("diskloz_base_url") . '/api/all_dealers_with_inventory_count');

            if (!$response->successful()) {
                $dealers = [];
            } else {
                $responseData = $response->json();
                $dealers = isset($responseData['data']) ? $responseData['data'] : [];

                // Inventory count safe
                foreach ($dealers as &$dealer) {
                    $dealer['inventory_count'] = isset($dealer['inventory']) && is_array($dealer['inventory'])
                        ? count($dealer['inventory'])
                        : (isset($dealer['inventory_count']) ? $dealer['inventory_count'] : 0);
                }
            }

            // Pagination
            $dealersCollection = collect($dealers);
            $paginatedDealers = new LengthAwarePaginator(
                $dealersCollection->slice(($page - 1) * $perPage, $perPage)->values(),
                $dealersCollection->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            // Pass to Blade
            return view('dealer-network', [
                'dealers' => $paginatedDealers,
                'current_page' => $paginatedDealers->currentPage(),
                'last_page' => $paginatedDealers->lastPage()
            ]);

        } catch (\Exception $e) {
            return view('dealer-network', [
                'dealers' => collect([]),
                'current_page' => 1,
                'last_page' => 1,
                'error' => $e->getMessage()
            ]);
        }
    }


}
