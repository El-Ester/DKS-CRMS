<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\PreviousEmployments;
use App\Models\CurrentEmployment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreviousEmploymentsController extends Controller
{
    public function showForm()
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        // $previousEmployments = PreviousEmployments::all();

        $previousEmployments = PreviousEmployments::where('candidate_id', $candidateId)->get();
        $currentEmployment = CurrentEmployment::where('candidate_id', $candidateId)->get();

        return view('employment.form', compact('previousEmployments', 'currentEmployment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_name' => 'required|string|max:255',
            'employer_name' => 'required|string|max:255',
            'employer_address' => 'required|string|max:255',
            'commencement_date' => 'required|date',
            'termination_date' => 'nullable|date',
            'employment_nature' => 'required|string|max:255',
            'reasons_for_leaving' => 'required|string|max:255',
        ]);

        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        PreviousEmployments::create([
            'candidate_id' => $candidateId,
            'post_name' => $request->input('post_name'),
            'employer_name' => $request->input('employer_name'),
            'employer_address' => $request->input('employer_address'),
            'commencement_date' => $request->input('commencement_date'),
            'termination_date' => $request->input('termination_date'),
            'employment_nature' => $request->input('employment_nature'),
            'reasons_for_leaving' => $request->input('reasons_for_leaving'),
        ]);

        return redirect()->route('employment.form')->with('success', 'Employment Details added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_name' => 'required|string|max:255',
            'employer_name' => 'required|string|max:255',
            'employer_address' => 'required|string|max:255',
            'commencement_date' => 'required|date',
            'termination_date' => 'nullable|date',
            'employment_nature' => 'required|string|max:255',
            'reasons_for_leaving' => 'required|string|max:255',
        ]);

        $previousEmployments = PreviousEmployments::findOrFail($id);
        $previousEmployments->update($request->only(['post_name', 'employer_name', 'employer_address', 'commencement_date', 'termination_date', 'employment_nature', 'reasons_for_leaving']));

        return redirect()->route('employment.form')->with('success', 'Employment details updated successfully.');
    }

    public function destroy($id)
    {
        $previousEmployments = PreviousEmployments::findOrFail($id);
        $previousEmployments->delete();

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
