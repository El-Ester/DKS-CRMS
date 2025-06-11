<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirectToDashboard()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'Admin':
                return redirect()->route('systemAdmin.dashboard');

            case 'DKS Staff':
                return redirect()->route('DKSstaff.dashboard');

            case 'Service Engineer':
                return redirect()->route('engineer.dashboard');

            default:
                abort(403, 'Unauthorized action.');
            }
    }

        public function index()
    {
        // Chart 1: Case Status Distribution
        $caseStatuses = Issue::select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->with('status')
            ->get();

        $statusLabels = $caseStatuses->pluck('status.status_title');
        $statusCounts = $caseStatuses->pluck('total');

        // Chart 2: Monthly Case Submissions
        $monthlyCases = Issue::select(
                DB::raw("DATE_FORMAT(created_at, '%b') as month"),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%m')"))
            ->get();

        $monthLabels = $monthlyCases->pluck('month');
        $monthCounts = $monthlyCases->pluck('total');

        // Chart 3: Cases by User Role
        $casesByRole = User::select('user_role', DB::raw('count(issues.issue_id) as total'))
            ->leftJoin('issues', 'users.user_id', '=', 'issues.user_id')
            ->leftJoin('roles', 'users.user_role', '=', 'roles.role_id')
            ->groupBy('user_role')
            ->with('role')
            ->get();

        $roleLabels = $casesByRole->map(fn($u) => $u->role->role_title ?? 'Unknown');
        $roleCounts = $casesByRole->pluck('total');

        return view('systemAdmin.dashboard', compact(
            'statusLabels', 'statusCounts',
            'monthLabels', 'monthCounts',
            'roleLabels', 'roleCounts'
        ));
    }


}
