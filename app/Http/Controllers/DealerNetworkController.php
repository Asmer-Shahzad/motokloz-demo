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
            Log::info('Dealer application received', $request->except('_token'));

            $validated = $request->validate([
                'dealership_name' => 'required|string|max:255',
                'contact_name'    => 'required|string|max:255',
                'contact_email'   => 'required|email|max:255',
                'contact_phone'   => 'required|string|max:20',
                'notes'           => 'nullable|string',
            ]);

            Mail::send('emails.dealer-application', [
                'dealership_name' => $validated['dealership_name'],
                'contact_name'    => $validated['contact_name'],
                'contact_email'   => $validated['contact_email'],
                'contact_phone'   => $validated['contact_phone'],
                'notes'           => $validated['notes'] ?? '',
                'submittedAt'     => now()->format('F j, Y \a\t g:i A'),
            ], function ($message) use ($validated) {
                $message->to('brandi@diskloz.com')
                        ->subject('New Dealer Application - ' . $validated['dealership_name'])
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
            Log::info('Support form submission received', $request->except('_token'));
            Log::info('Form Source: ' . $request->input('source'));

            $validated = $request->validate([
                'dealership_name' => 'required|string|max:255',
                'contact_name'    => 'required|string|max:255',
                'contact_email'   => 'required|email|max:255',
                'contact_phone'   => 'required|string|max:20',
                'notes'           => 'nullable|string',
                'source'          => 'nullable|string|max:100',
            ]);

            Mail::send('emails.support', [
                'type'            => 'Support Request',
                'source'          => $validated['source'] ?? '',
                'dealership_name' => $validated['dealership_name'],
                'contact_name'    => $validated['contact_name'],
                'contact_email'   => $validated['contact_email'],
                'contact_phone'   => $validated['contact_phone'],
                'notes'           => $validated['notes'] ?? '',
                'submittedAt'     => now()->format('F j, Y \a\t g:i A'),
            ], function ($message) use ($validated) {
                $subject = 'New Support Request - ' . ($validated['source'] ?? 'General') . ' - ' . $validated['dealership_name'];
                $message->to('support@motokloz.com')
                        ->subject($subject)
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

        Log::info('Subscribe attempt', ['email' => $userEmail]);

        Mail::send('emails.subscribe', [
            'userEmail'    => $userEmail,
            'subscribedAt' => now()->format('F j, Y \a\t g:i A'),
        ], function ($message) use ($userEmail) {
            $message->to('subscribe@motokloz.com')
                    ->subject('New Subscriber: ' . $userEmail);
        });

        Log::info('Mail sent successfully', ['email' => $userEmail]);

        return response()->json([
            'status'  => true,
            'message' => 'Subscribed successfully!'
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'status'  => false,
            'message' => $e->errors()['email'][0] ?? 'Validation error'
        ], 422);

    } catch (\Exception $e) {
        Log::error('Mail sending failed', [
            'email' => $request->email ?? null,
            'error' => $e->getMessage()
        ]);
        return response()->json([
            'status'  => false,
            'message' => 'Something went wrong!'
        ], 500);
    }
}
}
