<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\CurrentEmployment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrentEmploymentController extends Controller
{
    // public function showForm()
    // {
    //     $candidateId = Auth::guard('candidate')->id();

    //     if (!$candidateId) {
    //         return back()->with('error', 'User is not authenticated.');
    //     }

    //     $currentEmployment = CurrentEmployment::where('candidate_id', $candidateId)->get();

    //     return view('employment.form', compact('currentEmployment'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'post_name' => 'required|string|max:255',
            'organisation_type' => 'required|string|max:255',
            'employer_name' => 'required|string|max:255',
            'employer_address' => 'required|string|max:255',
            'commencement_date' => 'required|date',
            'employment_nature' => 'required|string|max:255',
            'monthly_salary' => 'required|numeric|min:0',
            'allowance' => 'required|numeric|min:0',
        ]);

        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        CurrentEmployment::create([
            'candidate_id' => $candidateId,
            'post_name' => $request->input('post_name'),
            'organisation_type' => $request->input('organisation_type'),
            'employer_name' => $request->input('employer_name'),
            'employer_address' => $request->input('employer_address'),
            'commencement_date' => $request->input('commencement_date'),
            'employment_nature' => $request->input('employment_nature'),
            'monthly_salary' => $request->input('monthly_salary'),
            'allowance' => $request->input('allowance'),
        ]);

        return redirect()->route('employment.form')->with('success', 'Employment Details added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_name' => 'required|string|max:255',
            'organisation_type' => 'required|string|max:255',
            'employer_name' => 'required|string|max:255',
            'employer_address' => 'required|string|max:255',
            'commencement_date' => 'required|date',
            'employment_nature' => 'required|string|max:255',
            'monthly_salary' => 'required|numeric|min:0',
            'allowance' => 'required|numeric|min:0',
        ]);

        $currentEmployment = CurrentEmployment::findOrFail($id);
        $currentEmployment->update($request->only(['post_name', 'organisation_type', 'employer_name', 'employer_address', 'commencement_date', 'employment_nature', 'monthly_salary', 'allowance']));

        return redirect()->route('employment.form')->with('success', 'Employment details updated successfully.');
    }

    public function destroy($id)
    {
        $currentEmployment = CurrentEmployment::findOrFail($id);
        $currentEmployment->delete();

        return redirect()->route('employment.form')->with('success', 'Employment details deleted successfully.');
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
