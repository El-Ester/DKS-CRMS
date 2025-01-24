<?php

namespace App\Http\Controllers;

use App\Models\SchoolQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Import the Auth facade
use Illuminate\Support\Facades\Session;
class SchoolQualificationsController extends Controller
{
    public function showForm()
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        $qualifications = SchoolQualification::where('candidate_id', $candidateId)->latest()->get();

        return view('school-qualifications.form', compact('qualifications'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'school_qualification' => 'required|string|max:255',
            'certificate_title' => 'required|string|max:255',
            'school_college_name' => 'required|string|max:255',
            'certificate_date' => 'required|date',
            'college_result' => 'required|string',
            'bahasa_melayu_result' => 'required|string',
            'english_result' => 'required|string',
            'mathematics_result' => 'required|string',
            'other_subjects' => 'nullable|array',
            'subjects_result' => 'nullable|array|in:0,1,2,3,4,5,6,7,8,A,B,C,D,E,F',
            'moe_accreditation' => 'nullable|string',
        ]);

        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        // Get the subjects and results from the request
        $otherSubjects = $request->input('other_subjects', []);
        $subjectsResult = $request->input('subjects_result', []);

        // Check that both arrays are of the same length
        if (count($otherSubjects) !== count($subjectsResult)) {
            return back()->with('error', 'The number of subjects and results must match.');
        }

        // Ensure only valid values are passed to the database
        $validResults = ['0', '1', '2', '3', '4', '5', '6', '7', '8', 'A', 'B', 'C', 'D', 'E', 'F'];

        // Filter invalid results
        $subjectsResult = array_filter($subjectsResult, function($result) use ($validResults) {
            return !empty($result) && in_array($result, $validResults);
        });

        // Ensure that the number of valid results still matches the subjects
        if (count($subjectsResult) !== count($otherSubjects)) {
            return back()->with('error', 'There are invalid results or unmatched subjects.');
        }

        // Convert the subjects and results arrays to strings
        $otherSubjectsString = implode(',', $otherSubjects);
        $subjectsResultString = implode(',', $subjectsResult);

        // Store the qualification data
        SchoolQualification::create([
            'school_qualification' => $request->input('school_qualification'),
            'certificate_title' => $request->input('certificate_title'),
            'school_college_name' => $request->input('school_college_name'),
            'certificate_date' => $request->input('certificate_date'),
            'college_result' => $request->input('college_result'),
            'bahasa_melayu_result' => $request->input('bahasa_melayu_result'),
            'english_result' => $request->input('english_result'),
            'mathematics_result' => $request->input('mathematics_result'),
            'other_subjects' => $otherSubjectsString,
            'subjects_result' => $subjectsResultString,
            'moe_accreditation' => $request->input('moe_accreditation', null),
            'candidate_id' => $candidateId, // Storing the authenticated candidate's ID
        ]);

        return redirect()->route('school-qualifications.form')->with('success', 'Qualification added successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'school_qualification' => 'required|string|max:255',
            'certificate_title' => 'required|string|max:255',
            'school_college_name' => 'required|string|max:255',
            'certificate_date' => 'required|date',
            'college_result' => 'required|string',
            'bahasa_melayu_result' => 'required|string',
            'english_result' => 'required|string',
            'mathematics_result' => 'required|string',
            'other_subjects' => 'nullable|array',
            'subjects_result' => 'nullable|in:0,1,2,3,4,5,6,7,8,A,B,C,D,E,F',
            'moe_accreditation' => 'nullable|string',
        ]);

        // Find the qualification by ID
        $qualification = SchoolQualification::findOrFail($id);
        $qualification->update($request->only([
            'school_qualification',
            'certificate_title',
            'school_college_name',
            'certificate_date',
            'college_result',
            'bahasa_melayu_result',
            'english_result',
            'mathematics_result',
            'other_subjects',
            'subjects_result',
            'moe_accreditation'
        ]));

        return redirect()->route('school-qualifications.form')->with('success', 'Qualification updated successfully.');
    }

    public function destroy($id)
    {
        $qualification = SchoolQualification::findOrFail($id);
        $qualification->delete();

        return redirect()->route('school-qualifications.form')->with('success', 'Qualification deleted successfully.');
    }



    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }

}
