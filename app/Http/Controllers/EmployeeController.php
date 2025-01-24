<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Employee; // Ensure you have an Employee model

class EmployeeController extends Controller
{
    public function index()
    {
        // Fetch employees and their KPI data (update the logic as needed)
        $employees = Employee::all(); // Adjust query based on your database structure

        return view('hrd.manage_employees.index', compact('employees'));
    }



public function someAction()
{
    // Your action logic

    // Set success message in session
    session()->flash('success', 'Your action was successful!');

    return redirect()->route('your.route');
}

}

