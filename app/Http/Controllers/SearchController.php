<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\UserInformation;
use App\Models\User;
use App\Http\Controllers\Concerns\EnrichesVehicleLocation;
use App\Services\DistanceCalculation\FsaCentroidGeocoder;


class SearchController extends Controller
{
    use EnrichesVehicleLocation;






    public function curl_get($url): JsonResponse
    {
        $json = ["status" => false, "message" => "", "data" => []];
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
        if ($status_code > 199 && $status_code < 203) {
            $json["status"] = true;
        }
        $json["data"] = json_decode($result);
        return response()->json($json);
    }



    public function search_inventory(Request $request)
    {
        $selectedAsset = $request->selected_asset;
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

        $selectedDistance = $request->input('selected_distance', '');
        $userLat          = $request->input('user_lat');
        $userLng          = $request->input('user_lng');
        $hasGps = is_numeric($userLat) && is_numeric($userLng);
        $distanceFilterActive = $hasGps && $selectedDistance !== '' && $selectedDistance !== 'national';

        $apiData = [
            'selected_make' => $request->selected_make,
            'selected_year' => $request->selected_year,
            'selected_model' => $request->selected_model,
            'selected_body_style' => $request->selected_body_style,
            'selected_mileage' => $request->selected_mileage,
            'selected_condition' => $request->selected_condition,
            'selected_lowest_price' => $request->selected_lowest_price,
            'selected_highest_price' => $request->selected_highest_price,
            'selected_asset' => $request->selected_asset,
            'selected_power' => $request->selected_power_type,
            'selected_fuel' => $request->selected_fuel_type,
            'selected_seller' => $request->selected_seller, // ✅ ADD THIS
            'keywords' => $request->keywords,
            'client_id' => auth()->check() ? auth()->id() : '',
            // If distance filter active, fetch ALL records (page 1, huge per_page) to filter across full dataset
            // Otherwise use normal pagination
            'page'     => $distanceFilterActive ? 1 : (int) ($request->page ?? 1),
            'per_page' => $distanceFilterActive ? 9999 : 9,
        ];

        $makeTypes = [];
        $bodyStyleTypes = [];

        $res = Http::get($this->disklozBaseUrl() . '/api/search_inventory', [
            'selected_asset' => $selectedAsset,
            'per_page' => 1,
        ]);

        if ($res->successful()) {
            $inv = json_decode($res->body());

            /** ---------------- MAKES ---------------- */
            switch ($selectedAsset) {
                case 'AUTO':
                    $makes = $inv->filters->MfgAuto ?? [];
                    $bodyStyles = $inv->filters->BodyStyle ?? [];
                    break;

                case 'SNOWSPORTS':
                    $makes = $inv->filters->MfgSnowsport ?? [];
                    $bodyStyles = $inv->filters->BodyStyleSnowSport ?? [];
                    break;

                case 'WATERSPORT':
                    $makes = $inv->filters->MfgWatersport ?? [];
                    $bodyStyles = $inv->filters->BodyStyle ?? [];
                    break;

                case 'MARINE':
                    $makes = $inv->filters->MfgMarine ?? [];
                    $bodyStyles = $inv->filters->BodyStyle ?? [];
                    break;

                case 'RV / TRAILER':
                    $makes = $inv->filters->MfgRvTrailer ?? [];
                    $bodyStyles = $inv->filters->BodyStyleRvTrailer ?? [];
                    break;

                case 'MOTORCYCLE / ATV / POWERSPORTS':
                    $makes = $inv->filters->MfgMotorcycleAtv ?? [];
                    $bodyStyles = $inv->filters->BodyStyleMotorcycleAtv ?? [];
                    break;

                case 'HEAVY TRUCK/EQUIPMENT':
                    $makes = $inv->filters->MfgHeavyTruckEquipment ?? [];
                    $bodyStyles = $inv->filters->BodyStyleHeavyTruckEquipment ?? [];
                    break;

                case 'HEAVY DUTY TRAILERS':
                    $makes = $inv->filters->MfgHeavyDutyTrailer ?? [];
                    $bodyStyles = $inv->filters->BodyStyleHeavyDutyTrailer ?? [];
                    break;

                case 'FARM EQUIPMENT':
                    $makes = $inv->filters->MfgFarmEquipment ?? [];
                    $bodyStyles = $inv->filters->BodyStyleFarmEquipment ?? [];
                    break;

                default:
                    $makes = [];
                    $bodyStyles = [];
            }

            // ✅ Format Makes
            $makeTypes[$selectedAsset] = !empty($makes)
                ? collect($makes)->map(fn($m) => [
                    'id' => $m->id,
                    'name' => $m->name
                ])->sortBy('name')->values()
                : collect();

            // ✅ Format Body Styles
            $bodyStyleTypes[$selectedAsset] = !empty($bodyStyles)
                ? collect($bodyStyles)->map(fn($b) => [
                    'id' => $b->id,
                    'name' => $b->name
                ])->sortBy('name')->values()
                : collect();
        } else {
            $makeTypes[$selectedAsset] = collect();
            $bodyStyleTypes[$selectedAsset] = collect();
        }

        // Add sort to API request
        if ($request->filled('sort')) {
            $apiData['sort'] = $request->sort; // backend ko batao
        }

        /** ---------------- MAIN INVENTORY (ONLY ONCE) ---------------- */
        $response = Http::get($this->disklozBaseUrl() . '/api/search_inventory', $apiData);
        $result = json_decode($response->body());

        $inventory = $result->inventory ?? null;

        $dealerLocationMap = $this->dealerLocationMap();
        $motoklozUserMap   = $this->motoklozUserLocationMap();

        $inventoryData = collect($inventory->data ?? [])->map(function ($vehicle) use ($dealerLocationMap, $motoklozUserMap) {
            return $this->enrichVehicleLocation($vehicle, $motoklozUserMap, $dealerLocationMap);
        })->values();

        // ✅ SORTING (SAFE + CLEAN)
        if ($request->filled('sort')) {
            switch ($request->sort) {

                case 'price_asc':
                    $inventoryData = $inventoryData->sortBy(fn($v) => (float) ($v->disclosed_price ?? 0));
                    break;

                case 'price_desc':
                    $inventoryData = $inventoryData->sortByDesc(fn($v) => (float) ($v->disclosed_price ?? 0));
                    break;

                case 'year_asc':
                    $inventoryData = $inventoryData->sortBy(fn($v) => (int) ($v->year ?? 0));
                    break;

                case 'year_desc':
                    $inventoryData = $inventoryData->sortByDesc(fn($v) => (int) ($v->year ?? 0));
                    break;

                case 'name_asc':
                    $inventoryData = $inventoryData->sortBy(fn($v) => strtolower(trim($v->title ?? '')));
                    break;

                case 'name_desc':
                    $inventoryData = $inventoryData->sortByDesc(fn($v) => strtolower(trim($v->title ?? '')));
                    break;
            }
        }

        // ✅ INDEX RESET (IMPORTANT)
        $inventoryData = $inventoryData->values();

        // ─────────────────────────────────────────────
        // DISTANCE FILTERING (GPS-based)
        // ─────────────────────────────────────────────
        if ($distanceFilterActive) {

            $geocoder   = new FsaCentroidGeocoder();
            $userCoords = [(float) $userLat, (float) $userLng];

            if ($selectedDistance === 'provincial') {
                // Resolve user province from GPS
                $userProvince = $geocoder->reverseGeocodeProvince((float) $userLat, (float) $userLng);

                if ($userProvince) {
                    $inventoryData = $inventoryData->filter(function ($vehicle) use ($userProvince) {
                        $dealerProvince = strtoupper(trim($vehicle->dealer_province ?? ''));
                        return $dealerProvince === '' || strcasecmp($dealerProvince, $userProvince) === 0;
                    })->values();
                } else {
                    Log::warning('Distance filter: could not resolve province from GPS', [
                        'lat' => $userLat, 'lng' => $userLng,
                    ]);
                }
            } else {
                $kmLimit = (int) $selectedDistance;

                if ($kmLimit > 0) {
                    $inventoryData = $inventoryData->filter(function ($vehicle) use (
                        $geocoder, $userCoords, $kmLimit
                    ) {
                        $dealerCoords = null;

                        if (!empty($vehicle->dealer_postal_code)) {
                            $dealerCoords = $geocoder->geocodePostalCode(
                                $vehicle->dealer_postal_code,
                                $vehicle->dealer_city    ?? null,
                                $vehicle->dealer_country ?? null
                            );
                        }

                        if ($dealerCoords === null && !empty($vehicle->dealer_city) && !empty($vehicle->dealer_province)) {
                            $dealerCoords = $geocoder->geocodeCityProvince(
                                $vehicle->dealer_city,
                                $vehicle->dealer_province,
                                $vehicle->dealer_country ?? null
                            );
                        }

                        if ($dealerCoords === null) {
                            // Location resolve nahi hui → strict filter, exclude karo
                            return false;
                        }

                        $dist = $this->haversineDistance($userCoords, $dealerCoords);

                        return $dist !== null && $dist <= $kmLimit;
                    })->values();
                }
            }
        }

        /** ---------------- FINAL DATA ---------------- */

        // When distance filter is active, we fetched all records and filtered them.
        // Now manually paginate the filtered results.
        $displayPerPage = 9;
        if ($distanceFilterActive) {
            $currentPage    = max(1, (int) ($request->page ?? 1));
            $totalFiltered  = $inventoryData->count();
            $pagedData      = $inventoryData->slice(($currentPage - 1) * $displayPerPage, $displayPerPage)->values();
            $lastPage       = max(1, (int) ceil($totalFiltered / $displayPerPage));
        } else {
            $currentPage   = $inventory->current_page ?? 1;
            $lastPage      = $inventory->last_page ?? 1;
            $totalFiltered = $inventory->total ?? 0;
            $pagedData     = $inventoryData;
        }

        $data = [
            'user' => $user,
            'userInfo' => $userInfo,
            'search_inventory_result' => $pagedData,
            'current_page' => $currentPage,
            'last_page' => $lastPage,
            'total_inventory' => $totalFiltered,
            'per_page' => $displayPerPage,

            'assets' => $assets,
            'makeTypes' => $makeTypes,
            'bodyStyleTypes' => $bodyStyleTypes,

            'assetType' => json_decode($this->curl_get('/api/assetType')->getContent())->data ?? [],
            'conditions' => json_decode($this->curl_get('/api/conditions')->getContent())->data ?? [],

            'assetWord' => $request->selected_asset
                ? ucfirst(strtolower($request->selected_asset))
                : 'Car',

            'selected_body_style' => $request->selected_body_style,
            'disklozBaseUrl' => $this->disklozBaseUrl(),

            // Distance filter state passed to view
            'selected_distance' => $selectedDistance,
            'user_lat'          => $hasGps ? (float) $userLat : null,
            'user_lng'          => $hasGps ? (float) $userLng : null,
        ];



        return view('car-listing', $data);
    }

    public function testDriveMail(Request $request)
    {
        try {
            // Log request
            Log::info('Test drive request received', $request->except('_token'));

            // Validate
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'date' => 'required|date',
                'dealer_email' => 'required|email'
            ]);

            $dealerEmail = $validated['dealer_email'];

            Mail::send('emails.generic-notification', [
                'title' => 'New Test Drive Request',
                'heading' => 'New Test Drive Request',
                'subtitle' => 'Submitted via Motokloz',
                'intro' => 'A new test drive request has been submitted. Details are below.',
                'rows' => [
                    ['label' => 'Name', 'value' => $validated['name']],
                    ['label' => 'Email', 'value' => $validated['email']],
                    ['label' => 'Phone', 'value' => $validated['phone']],
                    ['label' => 'Preferred Date', 'value' => $validated['date']],
                    ['label' => 'Vehicle ID', 'value' => $request->vehicle_id ?? 'N/A'],
                    ['label' => 'Message', 'value' => $request->message ?? 'No message'],
                    ['label' => 'Submitted At', 'value' => now()->format('Y-m-d H:i:s')],
                ],
                'footer' => 'This request was submitted via Motokloz. Please contact the customer directly.',
            ], function ($message) use ($dealerEmail, $validated) {
                $message->to($dealerEmail)
                    ->subject('New Test Drive Request - ' . $validated['name'])
                    ->replyTo($validated['email'], $validated['name']);
            });

            Log::info('Test drive email sent to: ' . $dealerEmail);

            return response()->json([
                'success' => true,
                'message' => 'Test drive request sent successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Test Drive Email Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send. Please try again.'
            ], 500);
        }
    }

    public function offerMail(Request $request)
    {
        try {
            // Log request
            Log::info('Offer request received', $request->except('_token'));

            // Validate
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'offer_price' => 'required|numeric',
                'dealer_email' => 'required|email'
            ]);

            $dealerEmail = $validated['dealer_email'];

            Mail::send('emails.generic-notification', [
                'title' => 'New Offer Request',
                'heading' => 'New Offer Request',
                'subtitle' => 'Submitted via Motokloz',
                'intro' => 'A new offer request has been submitted. Details are below.',
                'rows' => [
                    ['label' => 'Name', 'value' => $validated['name']],
                    ['label' => 'Email', 'value' => $validated['email']],
                    ['label' => 'Phone', 'value' => $validated['phone']],
                    ['label' => 'Offer Price', 'value' => '$' . number_format($validated['offer_price'], 2)],
                    ['label' => 'Vehicle ID', 'value' => $request->vehicle_id ?? 'N/A'],
                    ['label' => 'Submitted At', 'value' => now()->format('Y-m-d H:i:s')],
                ],
                'footer' => 'This request was submitted via Motokloz. Please contact the customer directly.',
            ], function ($message) use ($dealerEmail, $validated) {
                $message->to($dealerEmail)
                    ->subject('New Offer Request - $' . number_format($validated['offer_price'], 2))
                    ->replyTo($validated['email'], $validated['name']);
            });

            Log::info('Offer email sent to: ' . $dealerEmail);

            return response()->json([
                'success' => true,
                'message' => 'Offer sent successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Offer Email Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send. Please try again.'
            ], 500);
        }
    }

    public function contactMail(Request $request)
    {
        try {

            // Log request
            Log::info('Contact form request received', $request->except('_token'));

            // Validate
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'message' => 'required|string',
                'dealer_email' => 'required|email'
            ]);

            $dealerEmail = $validated['dealer_email'];

            Log::info('Sending contact email to: ' . $dealerEmail);

            Mail::send('emails.generic-notification', [
                'title' => 'New Contact Message',
                'heading' => 'New Contact Message',
                'subtitle' => 'Submitted via Motokloz',
                'intro' => 'A new contact message has been submitted. Details are below.',
                'rows' => [
                    ['label' => 'Name', 'value' => $validated['name']],
                    ['label' => 'Email', 'value' => $validated['email']],
                    ['label' => 'Phone', 'value' => $validated['phone']],
                    ['label' => 'Vehicle ID', 'value' => $request->vehicle_id ?? 'N/A'],
                    ['label' => 'Source', 'value' => $request->source ?? 'Website'],
                    ['label' => 'Message', 'value' => $validated['message']],
                    ['label' => 'Submitted At', 'value' => now()->format('Y-m-d H:i:s')],
                ],
                'footer' => 'This message was submitted via Motokloz. Please contact the customer directly.',
            ], function ($message) use ($dealerEmail, $validated) {
                $message->to($dealerEmail)
                    ->subject('New Contact Message - ' . $validated['name'])
                    ->replyTo($validated['email'], $validated['name']);
            });

            Log::info('Contact email sent to: ' . $dealerEmail);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Contact Email Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Haversine distance in km between two [lat, lng] pairs.
     */
    private function haversineDistance(?array $from, ?array $to): ?float
    {
        if ($from === null || $to === null) {
            return null;
        }
        [$lat1, $lng1] = $from;
        [$lat2, $lng2] = $to;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return 6371 * $c;
    }

    /**
     * Send test drive request email to dealer
     */
    public function MotokloztestDriveMail(Request $request)
    {
        try {

            // Log request
            Log::info('Test Drive Request Received', $request->except('_token'));

            // Validate
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'date' => 'required|date',
                'dealer_email' => 'required|email',
                'vehicle_id' => 'nullable',
                'message' => 'nullable|string',
                'source' => 'nullable|string'
            ]);

            $dealerEmail = $validated['dealer_email'];

            Log::info('Sending test drive email to dealer: ' . $dealerEmail);

            Mail::send('emails.generic-notification', [
                'title' => 'New Test Drive Request',
                'heading' => 'New Test Drive Request',
                'subtitle' => 'Submitted via Motokloz',
                'intro' => 'A new test drive request has been submitted. Details are below.',
                'rows' => array_values(array_filter([
                    ['label' => 'Name', 'value' => $validated['name']],
                    ['label' => 'Email', 'value' => $validated['email']],
                    ['label' => 'Phone', 'value' => $validated['phone']],
                    ['label' => 'Preferred Date', 'value' => $validated['date']],
                    !empty($validated['vehicle_id']) ? ['label' => 'Vehicle ID', 'value' => $validated['vehicle_id']] : null,
                    !empty($validated['message']) ? ['label' => 'Customer Message', 'value' => $validated['message']] : null,
                    ['label' => 'Source', 'value' => $validated['source'] ?? 'Motokloz Website'],
                    ['label' => 'Submitted At', 'value' => now()->format('Y-m-d H:i:s')],
                    ['label' => 'IP Address', 'value' => $request->ip()],
                ])),
                'footer' => 'This request was submitted via Motokloz. Please contact the customer directly.',
            ], function ($message) use ($dealerEmail, $validated) {
                $message->to($dealerEmail)
                    ->subject('New Test Drive Request - ' . $validated['name'])
                    ->from('no-reply@diskloz.com', 'Motokloz')
                    ->replyTo($validated['email'], $validated['name']);
            });

            Log::info('Test drive email sent successfully to: ' . $dealerEmail);

            return response()->json([
                'success' => true,
                'message' => 'Test drive request sent to dealer successfully!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Test Drive Validation Error: ' . json_encode($e->errors()));

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Test Drive Email Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send email. Please try again.'
            ], 500);
        }
    }
}
