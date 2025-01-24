<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public function index(Request $request)
    {
        // Retrieve all jobs from the database
        $jobs = Job::all();

        // Get the 'filter' parameter from the request, default to 'all' if not set
        $filter = $request->get('filter', 'all');

        // Return the view and pass the jobs and filter data
        return view('frontpage.frontpage', compact('jobs', 'filter'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'open_date' => 'required|date',
            'close_date' => 'required|date',
            'status' => 'required|in:draft,open,closed',
            'working_period' => 'nullable|string',  // Only working_period field
            'min_requirements' => 'required|string',
            'document_required' => 'required|string',
        ]);

        // Ensure that working_period is provided if no employment contract
        if (is_null($request->working_period)) {
            return back()->withErrors(['error' => 'Please provide a working period.']);
        }

        $job = new Job($validated);
        $job->editor_id = auth()->user()->id;
        $job->save();

        return redirect()->route('hrd.manage_hiring.index')->with('success', 'Job created successfully');
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'payment_amount' => 'required|numeric',
            'payment_type' => 'required|string',
            'min_requirements' => 'required|string',
            'document_required' => 'required|string',
            'working_period' => 'nullable|string',  // Only working_period field
            'open_date' => 'required|date',
            'close_date' => 'required|date',
            'status' => 'required|string',
        ]);

        // Ensure that working_period is provided if no employment contract
        if (is_null($request->working_period)) {
            return back()->withErrors(['error' => 'Please provide a working period.']);
        }

        $job->update($validated);
        $job->editor_id = auth()->user()->id;

        return redirect()->route('hrd.manage_hiring.index')->with('success', 'Job updated successfully');
    }

    public function show($id)
    {
        // Retrieve the job from the database by ID
        $job = Job::findOrFail($id);

        // Return the job details view and pass the job data
        return view('frontpage.job-details', compact('job'));
    }
    public function view($jobId)
    {
        $job = Job::findOrFail($jobId); // Fetch the job details by ID
        return view('jobs.view', compact('job'));
    }


    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }


}
