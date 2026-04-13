<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // -----------------------------
    // Show Login
    // -----------------------------
    public function showLogin()
    {
        return view('login');
    }

    // -----------------------------
    // Login User
    // -----------------------------
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Detect if input is email or username
        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Attempt login
        if (!Auth::attempt([$field => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->onlyInput('email');
        }

        // Regenerate session
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    // -----------------------------
    // Show Signup
    // -----------------------------
    public function showSignup()
    {
        return view('signup');
    }

    // -----------------------------
    // Register User
    // -----------------------------
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Auto login
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }

    // -----------------------------
    // Login (AJAX)
    // -----------------------------
    public function loginAjax(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (!Auth::attempt([$field => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
            return response()->json(['success' => false, 'message' => 'Invalid credentials.'], 401);
        }

        $request->session()->regenerate();

        // Build chat redirect if inventory/dealer intent passed
        $inventoryId = $request->input('intended_inventory_id');
        $dealerId    = $request->input('intended_dealer_id');

        if ($inventoryId && $dealerId) {
            $redirectUrl = route('chat.show', [Auth::id(), $dealerId, $inventoryId]);
        } else {
            $redirectUrl = $request->session()->pull('intended_chat_url', route('home'));
        }

        return response()->json(['success' => true, 'redirect' => $redirectUrl]);
    }

    // -----------------------------
    // Register (AJAX)
    // -----------------------------
    public function registerAjax(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // Build chat redirect if inventory/dealer intent passed
        $inventoryId = $request->input('intended_inventory_id');
        $dealerId    = $request->input('intended_dealer_id');

        if ($inventoryId && $dealerId) {
            $redirectUrl = route('chat.show', [Auth::id(), $dealerId, $inventoryId]);
        } else {
            $redirectUrl = $request->session()->pull('intended_chat_url', route('home'));
        }

        return response()->json(['success' => true, 'redirect' => $redirectUrl]);
    }

    // -----------------------------
    // Logout
    // -----------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // -----------------------------
    // OAuth: Redirect to Provider
    // -----------------------------
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // -----------------------------
    // OAuth: Handle Callback
    // -----------------------------
    public function handleProviderCallback(Request $request, string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['oauth' => 'OAuth login failed. Please try again.']);
        }

        // Find or create user
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name'              => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'email'             => $socialUser->getEmail(),
                'password'          => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        // Redirect to intended chat URL if set
        $intendedUrl = $request->session()->pull('intended_chat_url', route('home'));

        return redirect($intendedUrl);
    }
}