<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Candidate;
use Illuminate\Http\Request;

class JPPSTMHiringController extends Controller
{
    // List all jobs
    public function index()
    {
        $jobs = Job::with('candidates')->get();
        return view('jppstm.manage_hiring.index', compact('jobs'));
    }

    // Show form for adding a job
    public function create()
    {
        return view('jppstm.manage_hiring.create');
    }

    // Store a new job
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'payment_amount' => 'required|numeric',
            'payment_type' => 'required|string',
            'working_period_amount' => 'required|numeric',
            'working_period_type' => 'required|string',
            'min_requirements' => 'required|string',
            'document_required' => 'required|string',
            'open_date' => 'required|date',
            'close_date' => 'required|date',
            'status' => 'required|string',
        ]);

            $job = new Job();
            $job->title = $validated['title'];
            $job->description = $validated['description'];
            $job->payment_amount = $validated['payment_amount'];
            $job->payment_type = $validated['payment_type'];
            $job->working_period_amount = $validated['working_period_amount'];
            $job->working_period_type = $validated['working_period_type'];
            $job->min_requirements = $validated['min_requirements'];
            $job->document_required = $validated['document_required'];
            $job->open_date = $validated['open_date'];
            $job->close_date = $validated['close_date'];
            $job->status = $validated['status'];

            $job->save();

            return redirect()->route('jppstm.manage_hiring.index');
        }

    // Show form for editing a job
    public function edit($id)
    {
        $job = Job::findOrFail($id); // Fetch the job by ID
        return view('jppstm.manage_hiring.edit', compact('job'));
    }


    // Update a job
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'payment_amount' => 'nullable|numeric',
            'payment_type' => 'nullable|string',
            'working_period_amount' => 'nullable|integer',
            'working_period_type' => 'nullable|string',
            'min_requirements' => 'nullable|string',
            'document_required' => 'nullable|string',
            'open_date' => 'nullable|date',
            'close_date' => 'nullable|date',
            'status' => 'required|string|in:draft,open,closed',
        ]);

        // Update hrd.manage_hiring table
            $hrdHiring = HrdHiring::find($id);
            $hrdHiring->update($request->all());

            // Update jppstm.manage_hiring table
            $jppstmHiring = JppstmHiring::find($id);
            $jppstmHiring->update($request->all());

            return redirect()->route('jppstm.index') -> with('success', 'Job updated successfully!');
    }

    // Delete a job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jppstm.manage_hiring.index')->with('success', 'Job deleted successfully!');
    }

    // Manage candidates for a job
    public function manageCandidates(Job $job)
    {
        // Fetch all applications for the job
        $applications = $job->jobApplications; // This fetches the related applications

        // If you have a separate "candidates" relationship, you can use it as well
        $candidates = $job->candidates;

        // Return the view with the job and the list of candidates/applications
        return view('jppstm.manage_hiring.candidates', compact('job', 'applications', 'candidates'));
    }


    public function view($jobId)
    {
        // Find the job by its ID
        $job = Job::findOrFail($jobId);

        // Return the view with the job data
        return view('jppstm.manage_hiring.view', compact('job'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);  // Find the job by its ID
        return view('job-poster', compact('job'));
    }



}
