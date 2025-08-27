<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Department;
use App\Models\Wo_Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogHelper;
use App\Models\ProgressActivity;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function index()
    {
        $roleAuth = Auth::user()->role->name;
        $deptAuth = Auth::user()->department->id;

        if (strcasecmp($roleAuth, 'admin') === 0) {
            //$data = Activity::with(['department', 'wo_number'])->get();


            $progressSub = DB::table('ProgressActivity as p1')
                ->select('p1.*')
                ->whereRaw('p1.activity_id = activity.id')
                ->orderByDesc('p1.ProgressPercent')
                ->limit(1);

            $data = Activity::with(['department', 'wo_number'])
                ->addSelect([
                    'progress_id'        => $progressSub->clone()->select('p1.id'),
                    'progress_date'      => $progressSub->clone()->select('p1.ProgressDate'),
                    'ProgressPercent'   => $progressSub->clone()->select('p1.ProgressPercent'),
                    'ProgressNote'    => $progressSub->clone()->select('p1.ProgressNote'),
                ])
                ->get();

            $counts = Activity::select('ActivityStatus', DB::raw('count(*) as total'))
                ->groupBy('ActivityStatus')
                ->pluck('total', 'ActivityStatus');
        } else {
            // $data = Activity::with(['department', 'wo_number'])
            //     ->where('department_id', $deptAuth)
            //     ->get();

            $progressSub = DB::table('progressactivity as p1')
                ->select('p1.*')
                ->whereRaw('p1.activity_id = activity.id')
                ->orderByDesc('p1.ProgressPercent')
                ->limit(1);

            $data = Activity::with(['department', 'wo_number'])
                ->where('department_id', $deptAuth)
                ->addSelect([
                    'progress_id'        => $progressSub->clone()->select('p1.id'),
                    'progress_date'      => $progressSub->clone()->select('p1.ProgressDate'),
                    'ProgressPercent'   => $progressSub->clone()->select('p1.ProgressPercent'),
                    'ProgressNote'    => $progressSub->clone()->select('p1.ProgressNote'),
                ])
                ->get();

            $counts = Activity::select('ActivityStatus', DB::raw('count(*) as total'))
                ->where('department_id', $deptAuth)
                ->groupBy('ActivityStatus')
                ->pluck('total', 'ActivityStatus');
        }

        $statusCounts = [
            'not_started' => $counts[0] ?? 0,
            'in_progress' => $counts[1] ?? 0,
            'completed'   => $counts[2] ?? 0,
        ];

        LOG::info($data);
        return view('page.report.allactivity.index', compact('data', 'statusCounts'));
    }
}
