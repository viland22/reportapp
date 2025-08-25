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
use Carbon\Carbon;

class WorkshopController extends Controller
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
        } else {
            $data = Activity::with(['department', 'wo_number'])
                ->where('department_id', $deptAuth)
                ->get();

            $counts = Activity::select('ActivityStatus', DB::raw('count(*) as total'))
                ->where('department_id', $deptAuth)
                ->groupBy('ActivityStatus')
                ->pluck('total', 'ActivityStatus');
        }

        // biar aman, kalau status tertentu tidak ada hasil, kasih default 0
        $statusCounts = [
            'not_started' => $counts[0] ?? 0,
            'in_progress' => $counts[1] ?? 0,
            'completed'   => $counts[2] ?? 0,
        ];

        return view('page.workshop.index', compact('data', 'statusCounts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {

        $data = Activity::findOrFail($id);

        return view('page.workshop.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        try {

            if ($request->action == 'update_start') {
                $request->validate([
                    'ActualStart' => 'required|date_format:d-M-y',
                ]);

                $activity = Activity::findOrFail($id);
                $activity->ActualStart = Carbon::parse($request->ActualStart)->format('Y-m-d');
                $activity->ActivityStatus = 1;
                $activity->save();

                LogHelper::record('success', 'update actual start', 'Workshop', $activity->id, 'Workshop updated successfully.');
                return redirect()->route('page.workshop.index')->with('success', 'Workshop actual start updated successfully.');
            } else if ($request->action == 'cancel_start') {
                $activity = Activity::findOrFail($id);
                $activity->ActualStart = null;
                $activity->ActivityStatus = 0;
                $activity->save();

                LogHelper::record('success', 'cancel actual start', 'Workshop', $activity->id, 'Workshop canceled successfully.');
                return redirect()->route('page.workshop.index')->with('success', 'Workshop actual start canceled successfully.');
            } else if ($request->action == 'update_finish') {
                $request->validate([
                    'ActualFinish' => 'required|date_format:d-M-y',
                    'Holiday' => 'required|integer|min:1',
                    'ActualDuration' => 'required|integer|min:1',
                    //'Remarks' => 'required|string|max:255',
                ]);

                $activity = Activity::findOrFail($id);
                $activity->ActualFinish = Carbon::parse($request->ActualFinish)->format('Y-m-d');
                $activity->Holiday = $request->Holiday;
                $activity->ActualDuration = $request->ActualDuration;
                $activity->Remarks = $request->Remarks;
                $activity->ActivityStatus = 2;
                $activity->save();

                LogHelper::record('success', 'update actual finish', 'Workshop', $activity->id, 'Workshop updated successfully.');
                return redirect()->route('page.workshop.index')->with('success', 'Workshop actual finish updated successfully.');
            } else if ($request->action == 'cancel_finish') {
                $activity = Activity::findOrFail($id);
                $activity->ActualFinish = null;
                $activity->Holiday = 0;
                $activity->ActualDuration = 0;
                $activity->Remarks = null;
                $activity->ActivityStatus = 1;
                $activity->save();

                LogHelper::record('success', 'cancel actual finish', 'Workshop', $activity->id, 'Workshop canceled successfully.');
                return redirect()->route('page.workshop.index')->with('success', 'Workshop actual finish canceled successfully.');
            }
        } catch (\Exception $e) {
            if ($request->action == 'update_start') {
                Log::error('Failed to update workshop actual start: ' . $e->getMessage());
                LogHelper::record('error', 'update workshop actual start', 'Workshop', $id, $e->getMessage(), $request->all());
                $errorMessage = 'An error occurred while updating activity data, please contact the administrator to see the logs.';
                return redirect()->back()->withInput()->with('error', $errorMessage);
            } else if ($request->action == 'cancel_start') {
                Log::error('Failed to cancel workshop actual start: ' . $e->getMessage());
                LogHelper::record('error', 'cancel workshop actual start', 'Workshop', $id, $e->getMessage(), $request->all());
                $errorMessage = 'An error occurred while updating activity data, please contact the administrator to see the logs.';
                return redirect()->back()->withInput()->with('error', $errorMessage);
            } else if ($request->action == 'update_finish') {
                Log::error('Failed to update workshop actual finish: ' . $e->getMessage());
                LogHelper::record('error', 'update workshop actual finish', 'Workshop', $id, $e->getMessage(), $request->all());
                $errorMessage = 'An error occurred while updating activity data, please contact the administrator to see the logs.';
                return redirect()->back()->withInput()->with('error', $errorMessage);
            } else if ($request->action == 'cancel_finish') {
                Log::error('Failed to cancel workshop actual finish: ' . $e->getMessage());
                LogHelper::record('error', 'cancel workshop actual finish', 'Workshop', $id, $e->getMessage(), $request->all());
                $errorMessage = 'An error occurred while updating activity data, please contact the administrator to see the logs.';
                return redirect()->back()->withInput()->with('error', $errorMessage);
            }
        }
    }


    public function destroy(string $id)
    {
        //
    }
}
