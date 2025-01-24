<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JppstmController extends Controller
{
    public function index()
    {
        // Fetch jobs for JPPSTM view
        $jobs = Job::all();
        return view('jppstm.manage_hiring.index', compact('jobs'));
    }
}

