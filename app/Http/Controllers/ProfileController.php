<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserInformation;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // ✅ Ab yeh kaam karega
        $userInfo = $user->information;
        
        if (!$userInfo) {
            $userInfo = new UserInformation();
        }
        
        $pageTitle = 'My Profile';
        
        return view('agent-setting', compact('user', 'userInfo', 'pageTitle'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $userInfo = $user->information ?? new UserInformation(); 
        $userInfo->user_id = $user->id;
        $userInfo->fill($request->only([
            'full_name', 'contact_number', 'personal_website', 
            'bio', 'languages', 'nationality'
        ]));
        $userInfo->save();

        return back()->with('success', 'Profile updated');
    }

    public function updateContact(Request $request)
    {
        $user = Auth::user();
        
        $userInfo = $user->information ?? new UserInformation(); 
        $userInfo->user_id = $user->id;
        $userInfo->fill($request->only([
            'country', 'city', 'complete_address', 'find_on_map', 'latitude', 'longitude' , 'postalCode'
        ]));
        $userInfo->save();

        return back()->with('success', 'Contact updated');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }
        
        $user->password = \Hash::make($request->new_password);
        $user->save();
        
        return back()->with('success', 'Password updated');
    }

    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            
            $user = Auth::user();
            $userInfo = $user->information ?? new UserInformation();
            
            // Delete old avatar if exists
            if ($userInfo->avatar && file_exists(public_path($userInfo->avatar))) {
                unlink(public_path($userInfo->avatar));
            }
            
            // Generate unique filename
            $filename = uniqid() . '_' . time() . '.' . $request->avatar->getClientOriginalExtension();
            
            // Create directory if not exists
            $destinationPath = public_path('uploads/avatars');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Move file
            $request->avatar->move($destinationPath, $filename);
            
            // Generate live URL
            $avatarUrl = asset('uploads/avatars/' . $filename);
            
            // Save to database
            $userInfo->user_id = $user->id;
            $userInfo->avatar = $avatarUrl;
            $userInfo->save();
            
            return response()->json([
                'success' => true,
                'avatar_url' => $avatarUrl,
                'message' => 'Avatar updated successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update avatar: ' . $e->getMessage()
            ]);
        }
    }

    public function deleteAvatar()
    {
        try {
            $user = Auth::user();
            
            if ($user->information && $user->information->avatar) {
                // Extract path from URL to delete file
                $avatarPath = parse_url($user->information->avatar, PHP_URL_PATH);
                $fullPath = public_path($avatarPath);
                
                if (file_exists($fullPath)) {
                    unlink($fullPath);
                }
                
                $user->information->avatar = null;
                $user->information->save();
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Avatar deleted successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete avatar: ' . $e->getMessage()
            ]);
        }
    }

}