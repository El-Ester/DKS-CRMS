<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    // Display the employment form
    public function showForm()
    {
        return view('employment.form');
    }

    // Store the employment data
    public function store(Request $request)
    {
        $request->validate([
            // Validation for previous employments
            'previous_employments.*.post_name' => 'nullable|string|max:255',
            'previous_employments.*.employer_name' => 'nullable|string|max:255',
            'previous_employments.*.employer_address' => 'nullable|string|max:500',
            'previous_employments.*.commencement_date' => 'nullable|date',
            'previous_employments.*.termination_date' => 'nullable|date',
            'previous_employments.*.employment_nature' => 'nullable|string|max:255',
            'previous_employments.*.reasons_for_leaving' => 'nullable|string|max:500',

            // Validation for current employment
            'current_employment.post_name' => 'nullable|string|max:255',
            'current_employment.organisation_type' => 'nullable|string|max:255',
            'current_employment.employer_name' => 'nullable|string|max:255',
            'current_employment.employer_address' => 'nullable|string|max:500',
            'current_employment.commencement_date' => 'nullable|date',
            'current_employment.employment_nature' => 'nullable|string|max:255',
            'current_employment.monthly_salary' => 'nullable|numeric',
            'current_employment.allowance' => 'nullable|numeric',

            // Validation for applied posts
            'applied_posts.*.post_applied_for' => 'nullable|string|max:255',
            'applied_posts.*.date_of_appointment' => 'nullable|date',
            'applied_posts.*.result' => 'nullable|string|max:255',
        ]);

        // Save previous employments
        foreach ($request->input('previous_employments') as $employment) {
            Employment::create([
                'post_name' => $employment['post_name'],
                'employer_name' => $employment['employer_name'],
                'employer_address' => $employment['employer_address'],
                'commencement_date' => $employment['commencement_date'],
                'termination_date' => $employment['termination_date'],
                'employment_nature' => $employment['employment_nature'],
                'reasons_for_leaving' => $employment['reasons_for_leaving'],
            ]);
        }

        // Save current employment
        Employment::create([
            'current_post_name' => $request->input('current_employment.post_name'),
            'organisation_type' => $request->input('current_employment.organisation_type'),
            'current_employer_name' => $request->input('current_employment.employer_name'),
            'current_employer_address' => $request->input('current_employment.employer_address'),
            'current_commencement_date' => $request->input('current_employment.commencement_date'),
            'current_employment_nature' => $request->input('current_employment.employment_nature'),
            'monthly_salary' => $request->input('current_employment.monthly_salary'),
            'allowance' => $request->input('current_employment.allowance'),
        ]);

        // Save applied posts
        foreach ($request->input('applied_posts') as $post) {
            Employment::create([
                'applied_for_post' => $post['post_applied_for'],
                'date_of_appointment' => $post['date_of_appointment'],
                'result' => $post['result'],
            ]);
        }

        return redirect()->route('employment.form')->with('success', 'Employment details added successfully.');
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
