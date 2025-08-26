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
        $progress = ProgressActivity::where('Activity_Id', $id)->orderBy('ProgressPercent', 'asc')->get();

        return view('page.workshop.edit', compact('data', 'progress'));
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
                $activity->RemarkStart = $request->RemarkStart;
                $activity->ActivityStatus = 1;
                $activity->save();

                //isi progress start
                ProgressActivity::create([
                    'Activity_Id'      => $id,
                    'ProgressDate'    => Carbon::parse($request->ActualStart)->format('Y-m-d'),
                    'ProgressPercent' => 0,
                    'ProgressNote'    => 'Workshop Actual Started',
                ]);

                LogHelper::record('success', 'update actual start', 'Workshop', $activity->id, 'Workshop updated successfully.');
                return redirect()->route('page.workshop.index')->with('success', 'Workshop actual start updated successfully.');
            } else if ($request->action == 'cancel_start') {
                $activity = Activity::findOrFail($id);
                $activity->ActualStart = null;
                $activity->ActivityStatus = 0;
                $activity->save();

                ProgressActivity::where('Activity_Id', $id)
                    ->where('ProgressPercent', 0)
                    ->forceDelete();

                LogHelper::record('success', 'cancel actual start', 'Workshop', $activity->id, 'Workshop canceled successfully.');
                return redirect()->route('page.workshop.index')->with('success', 'Workshop actual start canceled successfully.');
            } else if ($request->action == 'update_finish') {
                $request->validate([
                    'ActualFinish' => 'required|date_format:d-M-y',
                    'ActualHoliday' => 'required|integer|min:0',
                    'ActualDuration' => 'required|integer|min:0',
                    //'Remarks' => 'required|string|max:255',
                ]);

                $activity = Activity::findOrFail($id);
                $activity->ActualFinish = Carbon::parse($request->ActualFinish)->format('Y-m-d');
                $activity->ActualHoliday = $request->ActualHoliday;
                $activity->ActualDuration = $request->ActualDuration;
                $activity->RemarkFinish = $request->RemarkFinish;
                $activity->ActivityStatus = 2;
                $activity->save();

                //isi progress finish
                ProgressActivity::create([
                    'Activity_Id'      => $id,
                    'ProgressDate'    => Carbon::parse($request->ActualFinish)->format('Y-m-d'),
                    'ProgressPercent' => 100,
                    'ProgressNote'    => 'Workshop Actual Finished',
                ]);

                LogHelper::record('success', 'update actual finish', 'Workshop', $activity->id, 'Workshop updated successfully.');
                return redirect()->route('page.workshop.index')->with('success', 'Workshop actual finish updated successfully.');
            } else if ($request->action == 'cancel_finish') {
                $activity = Activity::findOrFail($id);
                $activity->ActualFinish = null;
                $activity->ActualHoliday = 0;
                $activity->ActualDuration = 0;
                $activity->RemarkFinish = null;
                $activity->ActivityStatus = 1;
                $activity->save();

                ProgressActivity::where('Activity_Id', $id)
                    ->where('ProgressPercent', 100)
                    ->forceDelete();

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

    public function storeProgress(Request $request, string $id)
    {
        Log::info($request->all());
        $request->validate([
            'ProgressDate' => 'required|date_format:d-M-y',
            'ProgressPercent' => 'required|integer|min:1',
            'ProgressNote' => 'required|string|max:255',
        ]);

        try {
            $ProgressDate = Carbon::parse($request->ProgressDate)->format('Y-m-d');
            $progressactivity = ProgressActivity::create([
                'Activity_Id' => $id,
                'ProgressDate' => $ProgressDate,
                'ProgressPercent' => $request->ProgressPercent,
                'ProgressNote' => $request->ProgressNote,
            ]);

            LogHelper::record('success', 'create', 'Progressactivity', $progressactivity->id, 'progressactivity created successfully.');
            return redirect()->route('page.workshop.index')->with('success', 'Progress activity added successfully.');
        } catch (\Exception $e) {
            Log::error('Gagal membuat progressactivity: ' . $e->getMessage());
            $errorMessage = 'An error occurred while adding progress activity data, please contact the administrator to see the logs.';

            LogHelper::record('error', 'create', 'progressactivity', null, $e->getMessage(), $request->except('_token'));
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function destroyProgress(string $id)
    {

        try {
            $ProgressActivity = ProgressActivity::findOrFail($id);
            $ProgressActivity->forceDelete();

            LogHelper::record('success', 'delete', 'Progressactivity', $ProgressActivity->id, 'progressactivity deleted successfully.');

            return redirect()->route('page.workshop.index')
                ->with('success', 'Progress activity deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete Progressactivity: ' . $e->getMessage());
            LogHelper::record('error', 'delete', 'Progressactivity', $id, $e->getMessage(), ['id' => $id]);
            return redirect()->route('page.workshop.index')
                ->with('error', 'An error occurred while deleting planning data, ' . $e->getMessage());
        }
    }
}
