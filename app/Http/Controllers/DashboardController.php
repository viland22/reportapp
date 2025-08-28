<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Activity;
use App\Models\ProgressActivity;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $roleAuth = Auth::user()->role->name;
        $deptAuth = Auth::user()->department->id;

        if (strcasecmp($roleAuth, 'admin') === 0) {
            $data = Activity::with(['department', 'wo_number'])->get();
            $counts = Activity::select('ActivityStatus', DB::raw('count(*) as total'))
                ->groupBy('ActivityStatus')
                ->pluck('total', 'ActivityStatus');

            $progress = ProgressActivity::from('progressactivity as a')
                ->leftJoin('activity as b', 'a.Activity_Id', '=', 'b.id')
                ->leftJoin('wo_numbers as c', 'b.wo_number_id', '=', 'c.id')
                ->where('b.ActivityStatus', '<', 2)
                ->whereRaw('a.ProgressPercent = (
                    SELECT MAX(p.ProgressPercent)
                    FROM progressactivity p
                    WHERE p.Activity_Id = a.Activity_Id
                )')
                ->select(
                    'a.*',
                    'b.ActivityId',
                    'b.ActivityName',
                    'c.wo_number'
                )
                ->get();
        } else {
            $data = Activity::with(['department', 'wo_number'])
                ->where('department_id', $deptAuth)
                ->get();

            $counts = Activity::select('ActivityStatus', DB::raw('count(*) as total'))
                ->where('department_id', $deptAuth)
                ->groupBy('ActivityStatus')
                ->pluck('total', 'ActivityStatus');

            $progress = ProgressActivity::from('progressactivity as a')
                ->leftJoin('activity as b', 'a.Activity_Id', '=', 'b.id')
                ->leftJoin('wo_numbers as c', 'b.wo_number_id', '=', 'c.id')
                ->where('b.department_id', $deptAuth)
                ->where('b.ActivityStatus', '<', 2)
                ->whereRaw('a.ProgressPercent = (
                    SELECT MAX(p.ProgressPercent)
                    FROM progressactivity p
                    WHERE p.Activity_Id = a.Activity_Id
                )')
                ->select(
                    'a.*',
                    'b.ActivityId',
                    'b.ActivityName',
                    'c.wo_number'
                )
                ->get();
        }

        $statusCounts = [
            'not_started' => $counts[0] ?? 0,
            'in_progress' => $counts[1] ?? 0,
            'completed'   => $counts[2] ?? 0,
        ];

        $total = array_sum($statusCounts);

        $percentages = [
            'not_started' => $total > 0 ? round(($statusCounts['not_started'] / $total) * 100, 2) : 0,
            'in_progress' => $total > 0 ? round(($statusCounts['in_progress'] / $total) * 100, 2) : 0,
            'completed'   => $total > 0 ? round(($statusCounts['completed'] / $total) * 100, 2) : 0,
        ];
        // Log::info($statusCounts);
        // Log::info($total);
        // Log::info($percentages);
        // Log::info($progress);
        return view('page.dashboard', compact('data', 'statusCounts', 'total', 'percentages', 'progress'));
    }
}
