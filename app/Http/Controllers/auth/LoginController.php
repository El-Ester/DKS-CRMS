<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // This method renders the login view
    public function index()
    {
        return view('auth.login', ['title' => 'Login']);
    }

    // This method processes the login form
    public function auth(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'username' => 'required|min:4',
            'password' => 'required|min:4'
        ]);

        $credentials = $request->only('username', 'password');

        try {
            // Attempt login
            if (Auth::attempt($credentials)) {
                $role = auth()->user()->role;

                // Redirect user based on their role
                switch ($role) {
                    case 'hrd':
                        return redirect()->route('hrd.dashboard');
                    case 'jppstm':
                        return redirect()->route('jppstm.dashboard');
                    // Add other roles as needed
                    default:
                        Auth::logout();
                        return redirect()->route('login')->with('error', 'Unauthorized role.');
                }
            } else {
                return back()->withErrors(['credentials' => 'Invalid username or password.']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['credentials' => 'An error occurred during login.']);
        }
    }

    // Logout method
    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}
