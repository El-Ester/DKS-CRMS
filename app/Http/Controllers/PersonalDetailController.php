<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\PersonalDetail;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Import the Auth facade

class PersonalDetailController extends Controller
{
    // Show the form with existing data
    public function create()
    {
        // Get the currently authenticated candidate's ID
        $candidateId = Auth::guard('candidate')->id();

        // Fetch the authenticated candidate's details
        $candidate = Candidate::find($candidateId);

        // Fetch existing personal details for the authenticated candidate
        $personalDetail = PersonalDetail::where('candidate_id', $candidateId)->first();

        // Pass both $candidate and $personalDetail to the view
        return view('personal_details.create', compact('personalDetail', 'candidate'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'identity_card_no' => 'required|string|max:255',
            'date_of_issue' => 'required|date',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'place_of_birth' => 'required|string|max:255',
            'gender' => 'required|in:Female,Male',
            'marital_status' => 'nullable|in:Single,Married,Others',
            'race' => 'required|string',
            'religion' => 'required|in:Muslim,Non-Muslim',
            'citizenship' => 'required|string',
            'certificate_number' => 'required|string|max:255',
            'driving_licence' => 'nullable|string|max:255',
            'licence_class' => 'nullable|string|max:255',
            'tel_house' => 'nullable|string|max:255',
            'tel_mobile' => 'required|string|max:255',
            'tel_fax' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:personal_details,email,' . Auth::guard('candidate')->id(),
            'permanent_address_line1' => 'required|string|max:255',
            'permanent_address_line2' => 'nullable|string|max:255',
            'permanent_country' => 'required|string|max:255',
            'permanent_province' => 'required|string|max:255',
            'permanent_postal_code' => 'required|string|max:255',
            'postal_address_line1' => 'required|string|max:255',
            'postal_address_line2' => 'nullable|string|max:255',
            'postal_country' => 'required|string|max:255',
            'postal_province' => 'required|string|max:255',
            'postal_postal_code' => 'required|string|max:255',
        ]);

        // Get the authenticated candidate's ID
        $validated['candidate_id'] = Auth::guard('candidate')->id();

        if (!$validated['candidate_id']) {
            return back()->with('error', 'User is not authenticated.');
        }

        // Save or update the personal details
        PersonalDetail::updateOrCreate(
            ['candidate_id' => $validated['candidate_id']], // Unique identifier
            $validated
        );

        return redirect()->route('personal_details.create')->with('success', 'Personal Details saved successfully.');
    }


    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }

}
