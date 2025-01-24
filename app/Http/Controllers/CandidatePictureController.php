<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidatePicture;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class CandidatePictureController extends Controller
{
    // Show the form to upload a picture
    public function showForm(Request $request)
    {
        $user = Auth::guard('candidate')->user();
        $data = Candidate::where('id', $user->id)->first();
        return view('upload-picture', ['data' => $data]);
    }


    // Handle picture upload
    public function uploadPicture(Request $request)
{
    // Validate the file input
    $request->validate([
        'picture' => 'required|image|mimes:jpeg,jpg,png|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('picture')) {
        $picture = $request->file('picture');
        $fileName = time() . '_' . $picture->getClientOriginalName();
        $picturePath = $picture->storeAs('public/passport_photos', $fileName);

        // Update candidate's picture path in the database
        $candidate = Auth::guard('candidate')->user();
        $candidate->picture = 'passport_photos/' . $fileName; // Save relative path
        $candidate->save();

        // Return with success message and picture path
        return redirect()->back()->with('success', 'Picture uploaded successfully')->with('picturePath', $candidate->picture);
    }

    return redirect()->back()->with('error', 'No picture uploaded.');
}


    // Handle removing the uploaded picture
    public function remove()
    {
        $user = Auth::guard('candidate')->user();  // Get the authenticated candidate
        $candidatePicture = Candidate::where('id', $user->id)->first();

        if ($candidatePicture) {
            // Delete the picture file from storage
            Storage::delete($candidatePicture->picture);

            // Delete the record from the database
            $candidatePicture->delete();

            return back()->with('success', 'Picture removed successfully!');
        }

        return back()->with('error', 'No picture found to remove.');
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}
