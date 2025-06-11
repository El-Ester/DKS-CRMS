<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Item;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class CaseController extends Controller
{
    private function getView($adminView, $staffView, $engineerView)
    {
        $role = Auth::user()->role->role_title ?? null;

        return match ($role) {
            'Admin' => $adminView,
            'DKS Staff' => $staffView,
            'Service Engineer' => $engineerView,
            default => abort(403, 'Unauthorized')
        };
    }

    private function redirectToCaseForm()
    {
        $role = Auth::user()->role->role_title ?? null;

        return match ($role) {
            'Admin' => redirect()->route('systemAdmin.addNewCase'),
            'DKS Staff' => redirect()->route('DKSstaff.addNewCase'),
            'Service Engineer' => redirect()->route('serviceEngineer.addNewCase'),
            default => abort(403, 'Unauthorized')
        };
    }

    public function index()
    {
        $cases = Issue::with(['status', 'user'])
            ->orderBy('created_date', 'desc')
            ->get();

        return view($this->getView('systemAdmin.Cases', 'DKSstaff.Cases', 'serviceEngineer.Cases'), compact('cases'));
    }

    public function create()
    {
        $users = User::where('is_suspended', false)->get();
        $statuses = Status::where('is_suspended', false)->get();

        $now = Carbon::now();
        $dateTimePart = $now->format('ymd-Hi');
        $countToday = Issue::whereDate('created_at', $now->toDateString())->count() + 1;
        $sequentialPart = str_pad($countToday, 3, '0', STR_PAD_LEFT);
        $generatedIssueNumber = "{$dateTimePart}-{$sequentialPart}";

        return view(
            $this->getView('systemAdmin.addNewCase', 'DKSstaff.addNewCase', 'serviceEngineer.addNewCase'),
            compact('users', 'statuses', 'generatedIssueNumber')
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'issue_date' => 'required|date',
            'status_id' => 'required|exists:statuses,status_id',
            'user_id' => 'required|exists:users,user_id',
            'customer_name' => 'required|string',
            'company' => 'nullable|string',
            'contact_no' => 'required|string',
            'customer_email' => 'required|email',
            'problem_statement' => 'required|string',
            'problem_verification' => 'nullable|string',
            'items' => 'nullable|array',
            'items.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Regenerate issue_number to ensure it's untampered and truly unique
        $now = Carbon::now();
        $dateTimePart = $now->format('ymd-Hi');
        $countToday = Issue::whereDate('created_at', $now->toDateString())->count() + 1;
        $sequentialPart = str_pad($countToday, 3, '0', STR_PAD_LEFT);
        $generatedIssueNumber = "{$dateTimePart}-{$sequentialPart}";

        // Create the issue
        $issue = Issue::create([
            'issue_number' => $generatedIssueNumber,
            'issue_date' => $request->issue_date,
            'status_id' => $request->status_id,
            'user_id' => $request->user_id,
            'customer_name' => $request->customer_name,
            'company' => $request->company,
            'contact_no' => $request->contact_no,
            'customer_email' => $request->customer_email,
            'problem_statement' => $request->problem_statement,
            'problem_verification' => $request->problem_verification,
            'created_date' => now(),
            'created_by_username' => Auth::user()->user_name,
            'is_suspended' => false,
        ]);

        // Save related items
        if ($request->has('items')) {
            foreach ($request->items as $itemName) {
                if (!empty($itemName)) {
                    Item::create([
                        'issue_id' => $issue->issue_id,
                        'items_name' => $itemName,
                    ]);
                }
            }
        }

        return $this->redirectToCaseForm()->with('success', 'Case created successfully.');
    }

    public function edit($id)
    {
        $case = Issue::findOrFail($id);
        $statuses = Status::where('is_suspended', false)->get();
        $users = User::where('is_suspended', false)->get();

        return view($this->getView('systemAdmin.editCase', 'DKSstaff.editCase', 'serviceEngineer.editCase'), compact('case', 'statuses', 'users'));
    }

    public function update(Request $request, $id)
    {
        $case = Issue::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'issue_date' => 'required|date',
            'customer_name' => 'required|string',
            'contact_no' => 'required|string',
            'customer_email' => 'required|email',
            'problem_statement' => 'required|string',
            'status_id' => 'required|exists:statuses,status_id',
            'user_id' => 'required|exists:users,user_id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $case->update([
            'issue_date' => $request->issue_date,
            'customer_name' => $request->customer_name,
            'company' => $request->company,
            'contact_no' => $request->contact_no,
            'customer_email' => $request->customer_email,
            'problem_statement' => $request->problem_statement,
            'problem_verification' => $request->problem_verification,
            'repair_cost' => $request->repair_cost,
            'work_description' => $request->work_description,
            'diagnostic_date' => $request->diagnostic_date,
            'completion_date' => $request->completion_date,
            'modified_date' => now(),
            'modified_by_username' => Auth::user()->user_name,
            'status_id' => $request->status_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('cases.index')->with('success', 'Case updated successfully.');
    }

    public function show($id)
    {
        $case = Issue::with(['status', 'user', 'items'])->findOrFail($id);
        return view($this->getView('systemAdmin.viewCase', 'DKSstaff.viewCase','serviceEngineer.viewCase'), compact('case'));
    }

    public function destroy($id)
    {
        $case = Issue::findOrFail($id);

        // Delete related items
        $case->items()->delete();

        // Delete the case
        $case->delete();

        return redirect()->route('cases.index')->with('success', 'Case deleted permanently.');
    }

    public function someAction()
    {
        session()->flash('success', 'Your action was successful!');
        return redirect()->route('your.route');
    }

    public function generateCaseReport($id)
    {
        $case = Issue::with(['user', 'status'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.caseReport', compact('case'));

        return $pdf->download('case_report_' . $case->issue_number . '.pdf');
    }

    public function generateFinalDiagnosticReport($id)
    {
        $case = Issue::with(['user', 'status'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.finalDiagnosticReport', compact('case'));

        return $pdf->download('final_diagnostic_report_' . $case->issue_number . '.pdf');
    }

}
