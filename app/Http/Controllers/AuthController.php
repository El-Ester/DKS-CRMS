<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Candidates; // Make sure this line is present
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showCandidatesRegisterForm()
    {
        return view('auth.candidates-register');
    }

    // Handle Job Seeker registration
    public function registerCandidates(Request $request)
    {
        // Validate the input
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if email already exists
                if (Candidates::where('email', $request->email)->exists()) {
                    return redirect()->back()->with('error', 'Email is already registered.');
                }

        // Create a new Job Seeker user
        $candidates = Candidates::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'candidates', // Ensure you have a 'user_type' field in your User model
        ]);


        // Automatically log the user in (optional)
        auth()->login($candidates);

        // Redirect to the Job Seeker dashboard or login page
        return redirect()->route('candidates.dashboard')->with('success', 'Registration successful! Welcome!');
    }

    public function authenticateCandidates(Request $request)
    {
        // Validate the input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate
        $credentials = $request->only('username', 'password');

        if (Auth::guard('candidates')->attempt($credentials)) {
            // Authentication passed, redirect to Job Seeker dashboard
            return redirect()->route('candidates.dashboard');
        }

        // Authentication failed, redirect back with an error
        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function loginCandidates(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log the user in
        if (Auth::guard('candidates')->attempt($credentials)) {
            // Authentication passed, redirect to Job Seeker dashboard
            return redirect()->route('candidates.dashboard');
        }

        // Authentication failed, redirect back with error
        return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function logoutCandidates()
    {
        // Log out the job seeker
        Auth::guard('candidates')->logout();

        // Redirect to the login page or home
        return redirect()->route('candidates.login');
    }

}
