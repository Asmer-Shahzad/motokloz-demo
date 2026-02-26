<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

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
    // Logout
    // -----------------------------
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}