<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'user_password' => 'required|string'
        ]);

        // Find user by user_email column
        $user = User::where('user_email', $request->input('user_email'))->first();

        if (!$user) {
            return back()->withErrors([
                'credentials' => 'Invalid email or password.'
            ]);
        }

        // Verify password manually since your password field is user_password (hashed)
        if (!Hash::check($request->input('user_password'), $user->user_password)) {
            return back()->withErrors([
                'credentials' => 'Invalid email or password.'
            ]);
        }

        // Log in the user manually
        Auth::login($user);

        // Get the role title via relationship
        $roleTitle = $user->role->role_title ?? null;

        switch ($roleTitle) {
            case 'Admin':
                return redirect()->intended('/systemAdmin/dashboard');
            case 'DKS Staff':
                return redirect()->intended('/DKSstaff/dashboard');
            case 'Service Engineer':
                return redirect()->intended('/serviceEngineer/dashboard');
            default:
                Auth::logout();
                return back()->withErrors(['credentials' => 'Role not recognized.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
