<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CandidateAuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.candidate.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:candidates,username',
            'email' => 'required|string|email|max:255|unique:candidates,email',
            'phone_number' => 'required|string', // Added missing comma here
            'password' => 'required|string|min:6|confirmed',
        ]);

        Candidate::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number, // Ensure the phone number is saved
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('candidate.login')->with('success', 'Registration successful. Please log in.');
    }


    // Show login form
    public function showLoginForm()
    {
        return view('auth.candidate.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        Log::info('Login attempt:', ['username' => $validated['username']]);

        // Authenticate with the correct guard and credentials
        if (Auth::guard('candidate')->attempt([
            'username' => $validated['username'],
            'password' => $validated['password'],
        ])) {
            Log::info('Login successful:', ['username' => $validated['username']]);
            return redirect()->route('candidate.dashboard')->with('success', 'Login successful.');
        }

        Log::warning('Login failed:', ['username' => $validated['username']]);
        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    // Handle logout
    public function logout()
    {
        Auth::guard('candidate')->logout();
        return redirect()->route('candidate.login')->with('success', 'Logged out successfully.');
    }
}
