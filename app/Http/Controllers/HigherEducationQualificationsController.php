<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\HigherEducationQualification;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HigherEducationQualificationsController extends Controller
{
    public function showForm()
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        // Get all qualifications for the authenticated candidate
        $qualifications = HigherEducationQualification::where('candidate_id', $candidateId)->latest()->get();

        // Initialize an empty collection for courses
        $courses = collect();

        // Loop through each qualification to fetch associated courses
        foreach ($qualifications as $qualification) {
            $coursesForQualification = Course::where('higher_education_qualification_id', $qualification->id)->get();
            $courses = $courses->merge($coursesForQualification);
        }

        return view('higher-qualifications.form', compact('qualifications', 'courses'));
    }


    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'qualification_type' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'university_country' => 'nullable|string|max:255',
            'certificate_name' => 'nullable|string|max:255',
            'certificate_date' => 'nullable|date',
            'overall_result' => 'required|string',
            'courses_taken' => 'required|array', // Ensure courses_taken is an array
            'courses_taken.*' => 'required|string', // Each course should be a string
            'courses_result' => 'required|array', // Ensure courses_result is an array
            'courses_result.*' => 'required|string', // Each result should be a string
            'moe_accreditation' => 'nullable|string',
        ]);

        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        // Get the courses and results from the request
        $coursesTaken = $request->input('courses_taken', []);
        $coursesResult = $request->input('courses_result', []);

        // Check that both arrays have the same length
        if (count($coursesTaken) !== count($coursesResult)) {
            return back()->with('error', 'The number of courses and results must match.');
        }

        // Save the qualification details in the database
        $qualification = HigherEducationQualification::create([
            'candidate_id' => $candidateId,
            'qualification_type' => $request->qualification_type,
            'university_name' => $request->university_name,
            'university_country' => $request->university_country,
            'certificate_name' => $request->certificate_name,
            'certificate_date' => $request->certificate_date,
            'overall_result' => $request->overall_result,
            'moe_accreditation' => $request->moe_accreditation,
        ]);

        // Now, save each course and result pair
        foreach ($coursesTaken as $index => $course) {
            $qualification->courses()->create([
                'course_name' => $course,
                'course_result' => $coursesResult[$index],
            ]);
        }

        return redirect()->route('higher-qualifications.form')->with('success', 'Qualification details added successfully.');
    }

    public function destroy($id)
    {
        // Find the qualification by ID
        $qualification = HigherEducationQualification::findOrFail($id);

        // Delete associated courses first to maintain referential integrity
        Course::where('higher_education_qualification_id', $qualification->id)->delete();

        // Delete the qualification
        $qualification->delete();

        return redirect()->route('higher-qualifications.form')->with('success', 'Qualification deleted successfully.');
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
