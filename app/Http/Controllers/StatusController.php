<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = Status::all();
        return view('systemAdmin.Status', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('systemAdmin.statuses.create'); // <-- Create this blade view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status_title' => 'required|string|max:255',
            'status_description' => 'nullable|string',
        ]);

        Status::create([
            'status_title' => $request->status_title,
            'status_description' => $request->status_description,
            'created_date' => now(),
            'created_by_username' => Auth::user()->username ?? 'admin',
        ]);

        return redirect()->route('statuses.index')->with('success', 'Status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        return view('systemAdmin.statuses.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        return view('systemAdmin.statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        $request->validate([
            'status_title' => 'required|string|max:255',
            'status_description' => 'nullable|string',
        ]);

        $status->update([
            'status_title' => $request->status_title,
            'status_description' => $request->status_description,
            'modified_date' => now(),
            'modified_by_username' => Auth::user()->username ?? 'admin',
        ]);

        return redirect()->route('statuses.index')->with('success', 'Status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('statuses.index')->with('success', 'Status deleted successfully.');
    }
}
