<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use DB;

class StaffController extends Controller
{
    public function index()
    {
        // Use the same logic as dashboard
        return $this->dashboard();
    }

    public function dashboard()
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
                DB::raw("YEAR(created_at) as year"),
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(*) as total")
            )
            ->groupBy(DB::raw("YEAR(created_at), MONTH(created_at)"))
            ->orderBy(DB::raw("YEAR(created_at), MONTH(created_at)"))
            ->get();

        $monthLabels = $monthlyCases->map(function ($row) {
            return Carbon::createFromDate($row->year, $row->month)->format('M Y');
        });

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

        return view('DKSstaff.dashboard', compact(
            'statusLabels', 'statusCounts',
            'monthLabels', 'monthCounts',
            'roleLabels', 'roleCounts'
        ));
    }
}
