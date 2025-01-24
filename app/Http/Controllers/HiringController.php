<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Candidate;
use App\Models\JPPSTMhiring;
use App\Models\HRDhiring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class HiringController extends Controller
{
    // List all jobs
    public function index()
    {
        $jobs = Job::get();
        return view('hrd.manage_hiring.index', compact('jobs'));
    }


    // Show form for adding a job
    public function create()
    {
        return view('hrd.manage_hiring.create');
    }

    // Store a new job
// Store a new job
public function store(Request $request)
{
    try {
        // Validation now accepts an array of skills
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'payment_amount' => 'required|numeric',
            'payment_type' => 'required|string',
            'working_period' => 'nullable|string',
            'education' => 'required|string',
            'skills' => 'required|array|min:1', // Expecting an array of skills
            'skills.*' => 'string', // Each skill in the array must be a string
            'experience' => 'required|integer|min:1',
            'document_required' => 'nullable|string', // Keep as nullable
            'open_date' => 'required|date',
            'close_date' => 'required|date',
            'job_type' => 'required|in:academic_post_local,non_academic_post_local,academic_post_expatriates',
            'status' => 'required|string',
        ]);

        // Save the job, converting skills array to a comma-separated string for storage
        $job = new Job();
        $job->title = $validated['title'];
        $job->description = $validated['description'];
        $job->payment_amount = $validated['payment_amount'];
        $job->payment_type = $validated['payment_type'];
        $job->working_period = $validated['working_period'];
        $job->education = $validated['education'];
        $job->skills = implode(',', $validated['skills']); // Store skills as a comma-separated string
        $job->experience = $validated['experience'];
        $job->document_required = $validated['document_required'] ?? null; // Handle nullable field
        $job->open_date = $validated['open_date'];
        $job->close_date = $validated['close_date'];
        $job->job_type = $validated['job_type'];
        $job->status = $validated['status'];

        $job->save();

        return redirect()->route('hrd.manage_hiring.index')->with('success', 'Job created successfully!');
    } catch (Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Please try again');
    }
}


// Show form for editing a job
public function edit($id)
{
    $job = Job::findOrFail($id); // Find the job by ID, or show a 404 error if not found
    return view('hrd.manage_hiring.edit', compact('job')); // Return the view with the job data
}


// Update a job
public function update(Request $request, $id)
{
    $job = Job::findOrFail($id);

    // Updated validation to handle an array of skills
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'payment_amount' => 'required|numeric',
        'payment_type' => 'required|string',
        'working_period' => 'nullable|string',
        'education' => 'required|string',
        'skills' => 'required|array|min:1', // Expecting an array of skills
        'skills.*' => 'string', // Each skill must be a string
        'experience' => 'required|integer|min:1',
        'document_required' => 'nullable|string',
        'open_date' => 'required|date',
        'close_date' => 'required|date',
        'status' => 'required|string|in:draft,open,closed',
    ]);

    // Update job, store skills as a comma-separated string
    $job->update([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'payment_amount' => $validatedData['payment_amount'],
        'payment_type' => $validatedData['payment_type'],
        'working_period' => $validatedData['working_period'],
        'education' => $validatedData['education'],
        'skills' => implode(',', $validatedData['skills']), // Store skills as a comma-separated string
        'experience' => $validatedData['experience'],
        'document_required' => $validatedData['document_required'] ?? null, // Handle nullable field
        'open_date' => $validatedData['open_date'],
        'close_date' => $validatedData['close_date'],
        'status' => $validatedData['status'],
    ]);

    return redirect()->route('hrd.manage_hiring.index')
                     ->with('success', 'Job updated successfully!');
}





    // Delete a job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('hrd.manage_hiring.index')->with('success', 'Job deleted successfully!');
    }

    // Manage candidates for a job
    public function manageCandidates(Job $job)
    {
        // Fetch all applications for the job
        $applications = $job->jobApplications; // This fetches the related applications

        // If you have a separate "candidates" relationship, you can use it as well
        $candidates = $job->candidates;

        // Return the view with the job and the list of candidates/applications
        return view('hrd.manage_hiring.candidates', compact('job', 'applications', 'candidates'));
    }


    public function view($jobId)
    {
        // Find the job by its ID
        $job = Job::findOrFail($jobId);

        // Return the view with the job data
        return view('hrd.manage_hiring.view', compact('job'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);  // Find the job by its ID
        return view('job-poster', compact('job'));
    }

    public function showCandidates($jobId)
    {
        $job = Job::find($jobId);
        $candidates = $job->candidates; // or some query to get the candidates
        return view('hrd.manage_candidates.index', compact('job', 'candidates'));
    }


    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }

}
