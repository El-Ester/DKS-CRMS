<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Job;

class HrdController extends Controller
{
    public function index()
    {
        // Fetch jobs for HRD view
        $jobs = Job::all();
        return view('hrd.manage_hiring.index', compact('jobs'));
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}

