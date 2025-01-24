<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Job;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    // Show the front page with job listings
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all'); // Retrieve filter parameter

        // Filter the jobs based on the filter
        $jobsQuery = Job::query();

        if ($filter !== 'all') {
            $jobsQuery->where('job_type', $filter);
        }

        $jobs = $jobsQuery->get();

        return view('frontpage.frontpage', compact('jobs', 'filter')); // Pass jobs and filter
    }

    // Show the Office of Human Resources page
    public function showHumanResources(Request $request)
    {
        $filter = $request->get('filter', 'all'); // Retrieve filter parameter

        // Optionally, you can add filtering logic here if you want to display filtered jobs on this page
        $jobsQuery = Job::query();

        if ($filter !== 'all') {
            $jobsQuery->where('job_type', $filter);
        }

        $jobs = $jobsQuery->get();

        return view('frontpage.frontpage', compact('jobs', 'filter')); // Pass jobs and filter to view
    }

    // Show jobs with specific filter
    public function jobsIndex($filter = 'all')
    {
        switch ($filter) {
            case 'academic_post_local':
                $jobs = Job::where('status', 'open')->where('job_type', 'academic_post_local')->get();
                break;
            case 'non_academic_post_local':
                $jobs = Job::where('status', 'open')->where('job_type', 'non_academic_post_local')->get();
                break;
            case 'academic_post_expatriates':
                $jobs = Job::where('status', 'open')->where('job_type', 'academic_post_expatriates')->get();
                break;
            default:
                $jobs = Job::where('status', 'open')->get();
        }

        return view('frontpage.index', compact('jobs', 'filter')); // Pass jobs and filter to view
    }


    // Method for viewing job details
    public function jobDetails($id)
    {
        $job = Job::findOrFail($id); // Get job by ID

        return view('frontpage.job-details', compact('job')); // Assuming you have a job-details view in frontpage folder
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
