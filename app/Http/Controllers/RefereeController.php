<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Referee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Import the Auth facade

class RefereeController extends Controller
{
    // Display the referee form
    public function showForm()
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        // Retrieve all referees to display in the view
        $referees = Referee::where('candidate_id', $candidateId)->get();

        // Return the view with the referees data
        return view('referee.form', compact('referees'));
    }

    // Store the referee data
// Store the referee data
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'occupation' => 'required|string|max:255',
        'years_known' => 'required|integer|min:1',
        'relation' => 'required|string|max:255',
        'address_line1' => 'required|string|max:255',
        'address_line2' => 'nullable|string|max:255',
        'address_line3' => 'nullable|string|max:255',
        'country' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'postal_code' => 'required|string|max:255',
        'telephone' => 'required|numeric',
        'fax' => 'nullable|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

    Referee::create([
        'name' => $request->input('name'),
        'occupation' => $request->input('occupation'),
        'years_known' => $request->input('years_known'),
        'relation' => $request->input('relation'),
        'address_line1' => $request->input('address_line1'),
        'address_line2' => $request->input('address_line2'),
        'address_line3' => $request->input('address_line3'),
        'country' => $request->input('country'),
        'province' => $request->input('province'),
        'postal_code' => $request->input('postal_code'),
        'telephone' => $request->input('telephone'),
        'fax' => $request->input('fax'),
        'email' => $request->input('email'),
        'candidate_id' => $candidateId, // Storing the authenticated candidate's ID
    ]);

    return redirect()->route('referee.form')->with('success', 'Referee added successfully.');
}


    // Show the referee form for editing
    public function edit($id)
    {
        // Find the referee by ID to edit
        $referee = Referee::where('candidate_id', $candidateId)->get();

        // Return the view with the referee data
        return view('referee.edit', compact('referee'));
    }

    // Update the referee data
    public function update(Request $request, $id)
    {
        // Validate the input data from the request
        $request->validate([
            'name' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'years_known' => 'required|integer|min:0',
            'relation' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Find the referee by ID
        $referee = Referee::where('candidate_id', $candidateId)->get();

        // Update the referee data
        $referee->update([
            'name' => $request->name,
            'occupation' => $request->occupation,
            'years_known' => $request->years_known,
            'relation' => $request->relation,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'address_line3' => $request->address_line3,
            'country' => $request->country,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
            'telephone' => $request->telephone,
            'fax' => $request->fax,
            'email' => $request->email,
        ]);

        // Redirect back with a success message
        return redirect()->route('referee.form')->with('success', 'Referee updated successfully.');
    }

    // Delete the referee data
    public function destroy($id)
    {
        // Find the referee by ID
        $referee = Referee::where('candidate_id', $candidateId)->get();

        // Delete the referee data
        $referee->delete();

        // Redirect back with a success message
        return redirect()->route('referee.form')->with('success', 'Referee deleted successfully.');
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
