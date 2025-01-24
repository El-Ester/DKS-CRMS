<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JobApplicationController extends Controller
{
    // Show available open jobs for the candidate to apply
    public function index()
{
    // Assume the candidate is the authenticated user
    $candidateId = auth()->id();

    // Fetch only jobs with status "open"
    $jobs = Job::where('status', 'open')->get();

    // Fetch the jobs that the candidate has already applied for
    $appliedJobs = JobApplication::with('job')
                                  ->where('candidate_id', $candidateId)  // Eager load the 'job' relationship
                                  ->get();

    // Uncomment the next line for debugging, but comment it out in production
    // dd($appliedJobs);

    return view('jobs.index', compact('jobs', 'appliedJobs'));
}


    // Handle the job application process
    public function apply($jobId)
{
    $candidateId = Auth::id();

    // Check if the candidate has already applied for the job
    $existingApplication = JobApplication::where('job_id', $jobId)
                                         ->where('candidate_id', $candidateId)
                                         ->first();

    if ($existingApplication) {
        return redirect()->back()->with('error', 'You have already applied for this job.');
    }

    // Retrieve the job and candidate data
    $job = Job::findOrFail($jobId);
    $candidate = Candidate::with(['higherEducationQualifications', 'trainings', 'previousEmployments'])->findOrFail($candidateId);

    // Check requirements
    $unfulfilledRequirements = [];

    // Education requirement
    if ($job->education) {
        $hasRequiredEducation = $candidate->higherEducationQualifications->contains(function ($qualification) use ($job) {
            return str_contains(strtolower($qualification->qualification_type), strtolower($job->education));
        });

        if (!$hasRequiredEducation) {
            $unfulfilledRequirements[] = "Education Level: " . $job->education;
        }
    }

    // Skills requirement
    if ($job->skills) {
        $requiredSkills = explode(',', $job->skills); // Assuming skills are stored as a comma-separated string
        $candidateSkills = $candidate->trainings->pluck('training_name')->toArray();

        $missingSkills = array_diff($requiredSkills, $candidateSkills);
        if (!empty($missingSkills)) {
            $unfulfilledRequirements[] = "Skills: " . implode(', ', $missingSkills);
        }
    }

    // Experience requirement
    if ($job->experience) {
        $hasRequiredExperience = $candidate->previousEmployments->contains(function ($employment) use ($job) {
            return str_contains(strtolower($employment->post_name), strtolower($job->experience));
        });

        if (!$hasRequiredExperience) {
            $unfulfilledRequirements[] = "Experience: " . $job->experience;
        }
    }

    // Return error if requirements are not fulfilled
    if (!empty($unfulfilledRequirements)) {
        return redirect()->back()->with('error', 'You did not fulfill this job\'s requirements: ' . implode('; ', $unfulfilledRequirements));
    }

    // Create the job application
    JobApplication::create([
        'job_id' => $jobId,
        'candidate_id' => $candidateId,
        'application_status' => 'pending', // Set default status
    ]);

    return redirect()->back()->with('success', 'Job application submitted successfully.');
}
public function destroy($id)
{
    // Find the job application by ID and delete it
    $application = JobApplication::findOrFail($id);
    $application->delete();

    // Redirect back with a success message
    return redirect()->route('jobs.index')->with('success', 'Job application deleted successfully.');
}

public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
