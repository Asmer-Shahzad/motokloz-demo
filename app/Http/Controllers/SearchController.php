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
            'keywords' => $request->keywords,
            'client_id' => auth()->check() ? auth()->id() : '',
            'page' => $request->page ?? 1,
            'per_page' => 9,
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
            switch($selectedAsset) {
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

        // ✅ LOOP only for filters (makes + body styles)
        // foreach ($assets as $asset) {

        //     $res = Http::get(env("diskloz_base_url").'/api/search_inventory', [
        //         'selected_asset' => $asset,
        //         'per_page' => 1,
        //     ]);

            // if ($res->successful()) {
            //     $inv = json_decode($res->body());

            //     /** ---------------- MAKES ---------------- */
            //     switch($asset) {
            //         case 'AUTO':
            //             $makes = $inv->filters->MfgAuto ?? [];
            //             $bodyStyles = $inv->filters->BodyStyle ?? [];
            //             break;

            //         case 'SNOWSPORTS':
            //             $makes = $inv->filters->MfgSnowsport ?? [];
            //             $bodyStyles = $inv->filters->BodyStyleSnowSport ?? [];
            //             break;

            //         case 'WATERSPORT':
            //             $makes = $inv->filters->MfgWatersport ?? [];
            //             $bodyStyles = $inv->filters->BodyStyle ?? [];
            //             break;

            //         case 'MARINE':
            //             $makes = $inv->filters->MfgMarine ?? [];
            //             $bodyStyles = $inv->filters->BodyStyle ?? [];
            //             break;

            //         case 'RV / TRAILER':
            //             $makes = $inv->filters->MfgRvTrailer ?? [];
            //             $bodyStyles = $inv->filters->BodyStyleRvTrailer ?? [];
            //             break;

            //         case 'MOTORCYCLE / ATV / POWERSPORTS':
            //             $makes = $inv->filters->MfgMotorcycleAtv ?? [];
            //             $bodyStyles = $inv->filters->BodyStyleMotorcycleAtv ?? [];
            //             break;

            //         case 'HEAVY TRUCK/EQUIPMENT':
            //             $makes = $inv->filters->MfgHeavyTruckEquipment ?? [];
            //             $bodyStyles = $inv->filters->BodyStyleHeavyTruckEquipment ?? [];
            //             break;

            //         case 'HEAVY DUTY TRAILERS':
            //             $makes = $inv->filters->MfgHeavyDutyTrailer ?? [];
            //             $bodyStyles = $inv->filters->BodyStyleHeavyDutyTrailer ?? [];
            //             break;

            //         case 'FARM EQUIPMENT':
            //             $makes = $inv->filters->MfgFarmEquipment ?? [];
            //             $bodyStyles = $inv->filters->BodyStyleFarmEquipment ?? [];
            //             break;

            //         default:
            //             $makes = [];
            //             $bodyStyles = [];
            //     }

            //     // ✅ Format Makes
            //     $makeTypes[$asset] = !empty($makes)
            //         ? collect($makes)->map(fn($m) => [
            //             'id' => $m->id,
            //             'name' => $m->name
            //         ])->sortBy('name')->values()
            //         : collect();

            //     // ✅ Format Body Styles
            //     $bodyStyleTypes[$asset] = !empty($bodyStyles)
            //         ? collect($bodyStyles)->map(fn($b) => [
            //             'id' => $b->id,
            //             'name' => $b->name
            //         ])->sortBy('name')->values()
            //         : collect();

            // } else {
            //     $makeTypes[$asset] = collect();
            //     $bodyStyleTypes[$asset] = collect();
            // }
        // }


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

        /** ---------------- FINAL DATA ---------------- */
        $data = [
            'user' => $user,
            'userInfo' => $userInfo,
            'search_inventory_result' => $inventoryData,
            'current_page' => $inventory->current_page ?? 1,
            'last_page' => $inventory->last_page ?? 1,
            'total_inventory' => $inventory->total ?? 0,
            'per_page' => $inventory->per_page ?? 9,

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

            // Prepare email content
            $emailBody = "==========================================\n";
            $emailBody .= "      NEW TEST DRIVE REQUEST\n";
            $emailBody .= "==========================================\n\n";
            $emailBody .= "Name: " . $validated['name'] . "\n";
            $emailBody .= "Email: " . $validated['email'] . "\n";
            $emailBody .= "Phone: " . $validated['phone'] . "\n";
            $emailBody .= "Preferred Date: " . $validated['date'] . "\n";
            $emailBody .= "Vehicle ID: " . ($request->vehicle_id ?? 'N/A') . "\n";
            $emailBody .= "Message: " . ($request->message ?? 'No message') . "\n";
            $emailBody .= "Submitted At: " . now()->format('Y-m-d H:i:s') . "\n";
            $emailBody .= "\n==========================================\n";

            // Send email - .env se config automatically lega
            Mail::raw($emailBody, function ($message) use ($dealerEmail, $validated) {
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

            // Prepare email content
            $emailBody = "==========================================\n";
            $emailBody .= "         NEW OFFER REQUEST\n";
            $emailBody .= "==========================================\n\n";
            $emailBody .= "Name: " . $validated['name'] . "\n";
            $emailBody .= "Email: " . $validated['email'] . "\n";
            $emailBody .= "Phone: " . $validated['phone'] . "\n";
            $emailBody .= "Offer Price: $" . number_format($validated['offer_price'], 2) . "\n";
            $emailBody .= "Vehicle ID: " . ($request->vehicle_id ?? 'N/A') . "\n";
            $emailBody .= "Submitted At: " . now()->format('Y-m-d H:i:s') . "\n";
            $emailBody .= "\n==========================================\n";

            // Send email - .env se config automatically lega
            Mail::raw($emailBody, function ($message) use ($dealerEmail, $validated) {
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

            // Prepare email content
            $emailBody = "==========================================\n";
            $emailBody .= "         NEW CONTACT MESSAGE\n";
            $emailBody .= "==========================================\n\n";
            $emailBody .= "Name: " . $validated['name'] . "\n";
            $emailBody .= "Email: " . $validated['email'] . "\n";
            $emailBody .= "Phone: " . $validated['phone'] . "\n";
            $emailBody .= "Vehicle ID: " . ($request->vehicle_id ?? 'N/A') . "\n";
            $emailBody .= "Source: " . ($request->source ?? 'Website') . "\n";
            $emailBody .= "Submitted At: " . now()->format('Y-m-d H:i:s') . "\n";
            $emailBody .= "\n--- Message ---\n";
            $emailBody .= $validated['message'] . "\n";
            $emailBody .= "\n==========================================\n";

            // Send email
            Mail::raw($emailBody, function ($message) use ($dealerEmail, $validated) {
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

            // Prepare email content
            $emailBody = "==========================================\n";
            $emailBody .= "         NEW TEST DRIVE REQUEST\n";
            $emailBody .= "==========================================\n\n";
            $emailBody .= "Customer Information:\n";
            $emailBody .= "-------------------\n";
            $emailBody .= "Name: " . $validated['name'] . "\n";
            $emailBody .= "Email: " . $validated['email'] . "\n";
            $emailBody .= "Phone: " . $validated['phone'] . "\n";
            $emailBody .= "Preferred Date: " . $validated['date'] . "\n\n";
            
            if (!empty($validated['vehicle_id'])) {
                $emailBody .= "Vehicle Information:\n";
                $emailBody .= "-------------------\n";
                $emailBody .= "Vehicle ID: " . $validated['vehicle_id'] . "\n\n";
            }
            
            if (!empty($validated['message'])) {
                $emailBody .= "Customer Message:\n";
                $emailBody .= "-------------------\n";
                $emailBody .= $validated['message'] . "\n\n";
            }
            
            $emailBody .= "Additional Information:\n";
            $emailBody .= "-------------------\n";
            $emailBody .= "Source: " . ($validated['source'] ?? 'Motokloz Website') . "\n";
            $emailBody .= "Submitted At: " . now()->format('Y-m-d H:i:s') . "\n";
            $emailBody .= "IP Address: " . $request->ip() . "\n";
            $emailBody .= "\n==========================================\n";
            $emailBody .= "This request was submitted via Motokloz.\n";
            $emailBody .= "Please contact the customer directly.\n";
            $emailBody .= "==========================================\n";

            // Send email
            Mail::raw($emailBody, function ($message) use ($dealerEmail, $validated) {
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