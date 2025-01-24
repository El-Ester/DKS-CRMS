<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CandidateDashboardController extends Controller
{
    public function index()
    {
        return view('candidate.dashboard');
    }
    

    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }

}
