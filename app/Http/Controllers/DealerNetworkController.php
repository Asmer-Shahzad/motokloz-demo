<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Concerns\EnrichesVehicleLocation;


class DealerNetworkController extends Controller
{
    use EnrichesVehicleLocation;
   
    public function fetch_dealers(Request $request)
    {
        
        $user = Auth::user();
        $userInfo = $user->information ?? new UserInformation();

        try {
            $page = $request->input('page', 1);
            $perPage = 15;
            
            $dealerName = $request->input('dealer_name');
            $postalCode = $request->input('postal_code');

            $response = Http::get($this->disklozBaseUrl() . '/api/all_dealers_with_inventory_count');

            if (!$response->successful()) {
                $dealers = [];
            } else {
                $responseData = $response->json();
                $dealers = isset($responseData['data']) ? $responseData['data'] : [];

                foreach ($dealers as &$dealer) {
                    $dealer['inventory_count'] = isset($dealer['inventory']) && is_array($dealer['inventory'])
                        ? count($dealer['inventory'])
                        : (isset($dealer['inventory_count']) ? $dealer['inventory_count'] : 0);
                }

                $dealers = collect($dealers)->filter(function ($dealer) use ($dealerName, $postalCode) {
                    $matches = true;
                    
                    if (!empty($dealerName)) {
                        $legalName = strtolower($dealer['dba'] ?? '');
                        $searchTerm = strtolower(trim($dealerName));
                        if (strpos($legalName, $searchTerm) === false) {
                            $matches = false;
                        }
                    }
                    
                    if (!empty($postalCode) && $matches) {
                        $dealerPostalCode = strtolower(trim($dealer['postal_code'] ?? 
                            $dealer['physical_address_postal_code'] ?? 
                            $dealer['zip_code'] ?? ''));
                        $searchPostal = strtolower(trim($postalCode));
                        
                        if (empty($dealerPostalCode) || strpos($dealerPostalCode, $searchPostal) === false) {
                            $matches = false;
                        }
                    }
                    
                    return $matches;
                })->values();
            }

            $dealersCollection = collect($dealers);
            $paginatedDealers = new LengthAwarePaginator(
                $dealersCollection->slice(($page - 1) * $perPage, $perPage)->values(),
                $dealersCollection->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            return view('dealer-network', [
                'user' => $user,
                'userInfo' => $userInfo,
                'dealers' => $paginatedDealers,
                'current_page' => $paginatedDealers->currentPage(),
                'last_page' => $paginatedDealers->lastPage(),
                'searchParams' => [
                    'dealer_name' => $dealerName,
                    'postal_code' => $postalCode
                ]
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

    public function dealer_application_submit(Request $request)
    {
        try {
            // Log request
            Log::info('Dealer application received', $request->except('_token'));
            
            // Validate
            $validated = $request->validate([
                'dealership_name' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                'contact_email' => 'required|email|max:255',
                'contact_phone' => 'required|string|max:20',
                'notes' => 'nullable|string',
            ]);

            // Prepare email content
            $emailContent = "==========================================\n";
            $emailContent .= "      NEW DEALER APPLICATION\n";
            $emailContent .= "==========================================\n\n";
            $emailContent .= "Dealership Name: " . $validated['dealership_name'] . "\n";
            $emailContent .= "Contact Name: " . $validated['contact_name'] . "\n";
            $emailContent .= "Contact Email: " . $validated['contact_email'] . "\n";
            $emailContent .= "Contact Phone: " . $validated['contact_phone'] . "\n";
            $emailContent .= "Notes: " . ($validated['notes'] ?? 'No notes provided') . "\n";
            $emailContent .= "Submitted At: " . now()->format('Y-m-d H:i:s') . "\n";
            // $emailContent .= "IP Address: " . $request->ip() . "\n";
            $emailContent .= "\n==========================================\n";

      
            // Send email
            Mail::raw($emailContent, function ($message) use ($validated) {
                $message->to('brandi@diskloz.com')
                        ->subject('New Dealer Application - ' . $validated['dealership_name'])
                        ->from('no-reply@diskloz.com', 'Diskloz')
                        ->replyTo($validated['contact_email'], $validated['contact_name']);
            });

            Log::info('Email sent successfully to brandi@diskloz.com');

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully! We will contact you soon.'
            ]);

        } catch (\Exception $e) {
            Log::error('Dealer application error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function support_submti(Request $request)
    {
        try {
            // Log request
            Log::info('Support form submission received', $request->except('_token'));
            
            // ✅ Log the source specifically
            Log::info('Form Source: ' . $request->input('source'));
            
            // Validate (add source validation if needed)
            $validated = $request->validate([
                'dealership_name' => 'required|string|max:255',
                'contact_name' => 'required|string|max:255',
                'contact_email' => 'required|email|max:255',
                'contact_phone' => 'required|string|max:20',
                'notes' => 'nullable|string',
                'source' => 'nullable|string|max:100',  // ✅ Add source validation
            ]);

            // Prepare email content with source
            $emailContent = "==========================================\n";
            $emailContent .= "      NEW SUPPORT REQUEST\n";
            $emailContent .= "==========================================\n\n";
            $emailContent .= "Source: " . ($validated['source'] ?? 'Not specified') . "\n";  // ✅ Add source
            $emailContent .= "------------------------------------------\n\n";
            $emailContent .= "Dealership Name: " . $validated['dealership_name'] . "\n";
            $emailContent .= "Contact Name: " . $validated['contact_name'] . "\n";
            $emailContent .= "Contact Email: " . $validated['contact_email'] . "\n";
            $emailContent .= "Contact Phone: " . $validated['contact_phone'] . "\n";
            $emailContent .= "Notes: " . ($validated['notes'] ?? 'No notes provided') . "\n";
            $emailContent .= "Submitted At: " . now()->format('Y-m-d H:i:s') . "\n";
            $emailContent .= "\n==========================================\n";


            // Send email
            Mail::raw($emailContent, function ($message) use ($validated) {
                $subject = 'New Support Request - ' . ($validated['source'] ?? 'General') . ' - ' . $validated['dealership_name'];
                $message->to('support@motokloz.com')
                        ->subject($subject)
                        ->from('noreply@motokloz.com', 'Motokloz')
                        ->replyTo($validated['contact_email'], $validated['contact_name']);
            });

            Log::info('Email sent successfully to support@motokloz.com from source: ' . ($validated['source'] ?? 'unknown'));

            return response()->json([
                'success' => true,
                'message' => 'Request submitted successfully! We will contact you soon.'
            ]);

        } catch (\Exception $e) {
            Log::error('Support form error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

public function subscribe_submit(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email'
        ]);

        $userEmail = $request->email;

        Log::info('Subscribe attempt', [
            'email' => $userEmail
        ]);

        Mail::raw('Test Mail from: ' . $userEmail, function ($message) {
            $message->to('subscribe@motokloz.com')
                    ->subject('Test Subscribe');
        });

        Log::info('Mail sent successfully', [
            'email' => $userEmail
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscribed successfully!'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {

        return response()->json([
            'status' => false,
            'message' => $e->errors()['email'][0] ?? 'Validation error'
        ], 422);

    } catch (\Exception $e) {

        Log::error('Mail sending failed', [
            'email' => $request->email ?? null,
            'error' => $e->getMessage()
        ]);

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong!'
        ], 500);
    }
}
}
