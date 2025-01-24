<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\CandidatePicture;

class ManageCandidatesController extends Controller
{
    public function index($jobId)
    {
        // Retrieve the job by its ID
        $job = Job::findOrFail($jobId);  // Make sure you're retrieving a single job model

        // dd($job);  // This will display the job object and stop further execution

        // Fetch job applications for this job
        $candidates = JobApplication::where('job_id', $jobId)
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->when(request('sort_by'), function ($query) {
                $query->orderBy(request('sort_by'), 'asc');
            })
            ->get();

        // Fetch pictures for each candidate (optional, if the picture is not part of the candidate model)
        foreach ($candidates as $application) {
            $application->candidate->picture = CandidatePicture::where('candidate_id', $application->candidate->id)->first();
        }
        // Pass the job and candidates to the view
        return view('hrd.manage_candidates.index', compact('job', 'candidates'));
    }

    public function manageCandidates($jobId)
    {
        $job = Job::findOrFail($jobId);  // Get the job by its ID

        // Fetch job applications along with candidate details
        $candidates = $job->jobApplications()
                        ->with('candidate')
                        ->get();

        return view('hrd.manage_candidates.index', compact('job', 'candidates'));
    }

    public function view($candidateId)
    {
        // Fetch the candidate and their related data
        $candidate = Candidate::with([
            'personalDetails',
            'trainings',
            'referees',
            'previousEmployments',
            'currentEmployment',
            'familyDetails'
        ])->findOrFail($candidateId);

        $jobId = $candidate->jobApplications()->first()->job_id ?? null;

        // Pass the data to the view
        return view('hrd.manage_candidates.view', compact('candidate', 'jobId'));
    }

    // Method to handle status update
    public function updateApplicationStatus(Request $request, $applicationId)
    {
        // Validate the request to ensure the status is one of the allowed values
        $request->validate([
            'application_status' => 'required|in:pending,accepted,rejected,reviewed,schedule interview,interviewed,put on hold,not a fit,hire,hired',
        ]);

        // Find the job application by ID
        $application = JobApplication::findOrFail($applicationId);

        // Update the application status
        $application->application_status = $request->input('application_status');
        $application->save();

        // Redirect back with a success message
        return redirect()->route('hrd.manage_candidates.index', ['jobId' => $application->job_id])
                         ->with('success', 'Application status updated successfully!');
    }

    public function showRejected($jobId)
    {
        // Retrieve the job by its ID
        $job = Job::findOrFail($jobId);

        // Get all rejected applicants for this job
        $rejectedApplicants = JobApplication::where('job_id', $jobId)
            ->where('application_status', 'rejected')
            ->get();

        // Pass the job and rejected applicants to the view
        return view('hrd.manage_candidates.rejected', compact('job', 'rejectedApplicants'));
    }



    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }

}
