<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function redirectToDashboard()
{
    $role = Auth::user()->role;

    switch ($role) {
        case 'hrd':
            return redirect()->route('hrd.dashboard');

        case 'jppstm':
            return redirect()->route('jppstm.dashboard');

        case 'applicant':
            return redirect()->route('applicant.dashboard');

        case 'faculty/centre':
            return redirect()->route('facultyCentre.dashboard');

        case 'department/unit':
            return redirect()->route('departmentUnit.dashboard');

        case 'board members':
            return redirect()->route('boardMembers.dashboard');

        case 'assistant registrar':
            return redirect()->route('assistantRegistrar.dashboard');

        default:
            abort(403, 'Unauthorized action.');
    }
}


    public function hrdDashboard()
    {
        return view('dashboards.hrd');
    }

    public function jppstmDashboard()
    {
        return view('dashboards.jppstm');
    }

    public function applicantDashboard()
    {
        // Fetch applications associated with the authenticated user
        // $applications = Application::where('user_id', Auth::id())->get();

        // Return the view with the applications data
        // return view('dashboards.applicant', compact('applications'));
    }



    public function facultyCentreDashboard()
    {
        return view('dashboards.facultyCentre');
    }

    public function departmentUnitDashboard()
    {
        return view('dashboards.departmentUnit');
    }

    public function boardMembersDashboard()
    {
        return view('dashboards.boardMembers');
    }

    public function assistantRegistrarDashboard()
    {
        return view('dashboards.assistantRegistrar');
    }





    public function addJobPost(Request $request)
    {
        Job::create($request->all());
        return back()->with('success', 'Job posted successfully.');
    }

    public function hrd()
    {
        return view('dashboards.hrd');
    }

    public function jppstm()
    {
        return view('dashboards.jppstm');
    }




    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }


    // Add other dashboard methods for roles...
}
