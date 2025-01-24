<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\FamilyDetails; // Ensure this is the correct model name
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyDetailsController extends Controller
{
    // Display the Family Details form
    public function showForm()
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        $familyDetails = FamilyDetails::where('candidate_id', $candidateId)->get(); // Ensure you're filtering by candidate_id

        return view('family-details.form', compact('familyDetails'));
    }

    // Store Family Details
    public function store(Request $request)
    {
        $request->validate([
            'relation' => 'required|in:Husband,Wife,Father,Mother,Children',
            'name' => 'required|string|max:255',
            'ic_no' => 'nullable|string|max:255',
            'd_o_b' => 'nullable|date',
            'age' => 'nullable|integer',
            'occupation_or_education' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'date_of_demise' => 'nullable|date',
        ]);

        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        FamilyDetails::create([
            'candidate_id' => $candidateId,
            'relation' => $request->input('relation'),
            'name' => $request->input('name'),
            'ic_no' => $request->input('ic_no'),
            'd_o_b' => $request->input('d_o_b'),
            'age' => $request->input('age'),
            'occupation_or_education' => $request->input('occupation_or_education'),
            'address' => $request->input('address'),
            'date_of_demise' => $request->input('date_of_demise'),
        ]);

        return redirect()->route('family-details.form')->with('success', 'Family detail added successfully.');
    }

    // Update Family Details
    public function update(Request $request, $id)
    {
        $request->validate([
            'relation' => 'required|in:Husband,Wife,Father,Mother,Children',
            'name' => 'required|string|max:255',
            'ic_no' => 'nullable|string|max:255',
            'd_o_b' => 'nullable|date',
            'age' => 'nullable|integer',
            'occupation_or_education' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'date_of_demise' => 'nullable|date',
        ]);

        $familyDetails = FamilyDetails::findOrFail($id);
        $familyDetails->update($request->only(['relation', 'name', 'ic_no', 'd_o_b', 'age', 'occupation_or_education', 'address', 'date_of_demise']));

        return redirect()->route('family-details.form')->with('success', 'Family Details updated successfully!');
    }

    // Delete Family Details
    public function destroy($id)
    {
        $familyDetails = familyDetails::findOrFail($id);
        $familyDetails->delete();

        return redirect()->route('family-details.form')->with('success', 'Family Details deleted successfully!');
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
