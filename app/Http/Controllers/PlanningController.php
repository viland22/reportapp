<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Department;
use App\Models\Wo_Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\LogHelper;
use Carbon\Carbon;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Activity::with(['department', 'wo_number'])->get();
        return view('page.planning.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        Log::info($departments);
        $wo_numbers = Wo_Number::all();
        return view('page.planning.create', compact('departments', 'wo_numbers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Membuat planning dengan data: ' . json_encode($request->all()));

        $request->validate([
            'ActivityId' => 'required|string|max:100',
            'ActivityName' => 'required|string|max:255',
            'wo_number_id' => 'required|exists:wo_numbers,id',
            'department_id' => 'required|exists:departments,id',
            'BLProjectStart' => 'required|date_format:d-M-y',
            'BLProjectFinish' => 'required|date_format:d-M-y',
            'BLDuration' => 'required|integer|min:1',
        ]);


        try {
            $start = Carbon::parse($request->BLProjectStart)->format('Y-m-d');
            $finish = Carbon::parse($request->BLProjectFinish)->format('Y-m-d');
            $activity = Activity::create([
                'ActivityId' => $request->ActivityId,
                'ActivityName' => $request->ActivityName,
                'wo_number_id' => $request->wo_number_id,
                'department_id' => $request->department_id,
                'BLProjectStart' => $start,
                'BLProjectFinish' => $finish,
                'BLDuration' => $request->BLDuration,
            ]);

            LogHelper::record('success', 'create', 'Planning', $activity->id, 'Planning created successfully.');
            return redirect()->route('page.planning.index')->with('success', 'Planning created successfully.');
        } catch (\Exception $e) {
            Log::error('Gagal membuat planning: ' . $e->getMessage());
            LogHelper::record('error', 'create', 'Planning', null, $e->getMessage(), $request->all());
            $errorMessage = 'An error occurred while adding planning data, please contact the administrator to see the logs.';
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Activity::findOrFail($id);
        $departments = Department::all();
        $wo_numbers = Wo_Number::all();

        return view('page.planning.edit', compact('data', 'departments', 'wo_numbers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
            'ActivityId' => 'required|string|max:100',
            'ActivityName' => 'required|string|max:255',
            'wo_number_id' => 'required|exists:wo_numbers,id',
            'department_id' => 'required|exists:departments,id',
            'BLProjectStart' => 'required|date_format:d-M-y',
            'BLProjectFinish' => 'required|date_format:d-M-y',
            'BLDuration' => 'required|integer|min:1',
        ]);
            $activity = Activity::findOrFail($id);
            Log::info('Activity found: ' . $activity->ActivityName);
            $activity->ActivityId = $request->ActivityId;
            $activity->ActivityName = $request->ActivityName;
            $activity->wo_number_id = $request->wo_number_id;
            $activity->department_id = $request->department_id;
            $activity->BLProjectStart = Carbon::parse($request->BLProjectStart)->format('Y-m-d');
            $activity->BLProjectFinish = Carbon::parse($request->BLProjectFinish)->format('Y-m-d');
            $activity->BLDuration = $request->BLDuration;

            $activity->save();

            LogHelper::record('success', 'update', 'Activity', $activity->id, 'Activity updated successfully.');

            return redirect()->route('page.planning.index')->with('success', 'Activity updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update activity: ' . $e->getMessage());
            LogHelper::record('error', 'update', 'Activity', $id, $e->getMessage(), $request->all());
            $errorMessage = 'An error occurred while updating activity data, please contact the administrator to see the logs.';
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $planning = Activity::findOrFail($id);
            $planning->delete();

            LogHelper::record('success', 'delete', 'Planning', $planning->id, 'Planning deleted successfully.');

            return redirect()->route('page.planning.index')
                ->with('success', 'Planning deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete planning: ' . $e->getMessage());
            LogHelper::record('error', 'delete', 'Planning', $id, $e->getMessage(), ['id' => $id]);
            return redirect()->route('page.planning.index')
                ->with('error', 'An error occurred while deleting planning data, ' . $e->getMessage());
        }
    }
}
