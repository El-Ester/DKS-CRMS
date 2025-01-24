<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CandidateController extends Controller
{

    public function index()
    {
        // Retrieve the list of jobs or any other data to display.
        $job = Job::all(); // Replace with your query logic.

        // Return the view for the candidate's dashboard or job listing page.
        return view('hrd.manage_candidates.index', compact('job'));
    }


    public function dashboard()
    {

        $jobs = Job::where('status', 'open') // Fetch only jobs with status "open"
        ->orderBy('open_date', 'desc') // Order by the most recent open date
        ->get();

        return view('candidate.dashboard', compact('jobs'));
    }

    public function jobDetails()
    {
        // Fetch the job by its ID or fail if it doesn't exist
        $jobs = Job::get(); // Fetch a single job, not multiple jobs

        // Return the view with the correct variable
        return view('candidate.jobApplication', compact('jobs')); // Pass $job to the view
    }


    public function applySubmit(Request $request, $id)
    {
        // Your logic to handle the job application form submission
        // For example, saving application data to the database

        // Redirect after form submission
        return redirect()->route('candidate.job.details', ['id' => $id])->with('success', 'Application submitted successfully!');
    }

    public function jobApplication()
    {
        // Logic for job application view or process
        return view('candidate.jobApplication');
    }

    public function applicantInfo()
    {
        return view('candidate.applicantInfo');
    }

    public function showApplicantInfo($id)
    {
        // Retrieve the job details using the $id if needed.
        $job = Job::findOrFail($id); // Assuming you have a Job model.

        // Pass the job details to the view.
        return view('candidate.applicantInfo', compact('job'));
    }

    public function submitApplication(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required',
            'resume' => 'required|mimes:pdf|max:2048',
        ]);

        // Save the application
        $application = new Application();
        $application->job_id = $id;
        $application->user_id = Auth::id();
        $application->phone = $request->phone;

        // Handle file upload
        if ($request->hasFile('resume')) {
            $application->resume = $request->file('resume')->store('resumes', 'public');
        }

        $application->save();

        return redirect()->route('candidate.dashboard')->with('success', 'Application submitted successfully!');
    }

    // Controller Method
    public function jobApplicationPage()
    {
        // Fetch applied jobs from the job_applications table

            $appliedJobs = JobApplication::where('candidate_id', auth()->user()->id)
                                ->with('job') // Ensure the related job data is loaded
                                ->get();

        // Fetch only open jobs for the dropdown selection
        $availableJobs = Job::where('status', 'open')->get();

        return view('candidate.jobApplication', [
            'appliedJobs' => $appliedJobs,
            'availableJobs' => $availableJobs,
        ]);
    }

    public function show($id = null)
    {
        if ($id) {
            // Fetch the data based on the ID
            $applicantInfo = Applicant::find($id);
            if (!$applicantInfo) {
                abort(404, 'Applicant not found');
            }
        } else {
            // Handle the default behavior (e.g., show empty form or general information)
            $applicantInfo = null;
        }

        return view('candidate.applicantInfo', compact('applicantInfo'));
    }

    public function showAppliedJobs()
{
    $candidate = Auth::guard('candidate')->user(); // Retrieve the logged-in candidate
    $appliedJobs = $candidate->appliedJobs()->with('job')->get(); // Fetch applied jobs with job details
    $openJobs = Job::where('status', 'open')->get(); // Fetch open jobs for dropdown

    return view('candidate.applied_jobs', [
        'appliedJobs' => $appliedJobs,
        'jobs' => $openJobs,
    ]);
}



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}


}
