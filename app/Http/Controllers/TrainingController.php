<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingController extends Controller
{

    // Display the training form with all trainings
    public function showForm()
    {
        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        $trainings = Training::where('candidate_id', $candidateId)->get();

        return view('training.form', compact('trainings'));
    }

    // Store the training data
    public function store(Request $request)
    {
        $request->validate([
            'training_type' => 'required|string',
            'training_name' => 'required|string|max:255',
            'date' => 'required|date',
            'organiser' => 'required|string|max:255',
        ]);

        $candidateId = Auth::guard('candidate')->id();

        if (!$candidateId) {
            return back()->with('error', 'User is not authenticated.');
        }

        Training::create([
            'training_type' => $request->input('training_type'),
            'training_name' => $request->input('training_name'),
            'date' => $request->input('date'),
            'organiser' => $request->input('organiser'),
            'candidate_id' => $candidateId, // Storing the authenticated candidate's ID
        ]);

        return redirect()->route('training.form')->with('success', 'Training added successfully.');
    }


    // Update the training data
    public function update(Request $request, $id)
    {
        $request->validate([
            'training_type' => 'required|string',
            'training_name' => 'required|string|max:255',
            'date' => 'required|date',
            'organiser' => 'required|string|max:255',
        ]);

        $candidateId = Auth::guard('candidate')->id();
        $training = Training::where('id', $id)->where('candidate_id', $candidateId)->firstOrFail();

        $training->update($request->only(['training_type', 'training_name', 'date', 'organiser']));

        return redirect()->route('training.form')->with('success', 'Training updated successfully.');
    }

    // Delete the training data
    public function destroy($id)
    {
        $candidateId = Auth::guard('candidate')->id();
        $training = Training::where('id', $id)->where('candidate_id', $candidateId)->firstOrFail();
        $training->delete();

        return redirect()->route('training.form')->with('success', 'Training deleted successfully.');
    }



    public function someAction()
    {
        // Your action logic

        // Set success message in session
        session()->flash('success', 'Your action was successful!');

        return redirect()->route('your.route');
    }

}
