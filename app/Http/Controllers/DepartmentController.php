<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\LogHelper;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Department::all();
        return view('page.department.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'initial' => 'required|string|max:10',
            'name' => 'required|string|max:100',
        ]);

        try {
            $department = Department::create([
                'name' => $request->name,
                'initial' => $request->initial,
            ]);

            LogHelper::record('success','create', 'Department', $department->id, 'Department added successfully.');

            return redirect()->route('page.department.index')->with('success', 'Department added successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create department: ' . $e->getMessage());
            LogHelper::record('error','create', 'Department', null, $e->getMessage(), $request->all());
            $errorMessage = 'An error occurred while adding department data, please contact the administrator to see the logs.';
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
        $data = Department::findOrFail($id);

        Log::info($data);
        return view('page.department.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info($request->all());
        Log::info($id);
        $request->validate([
            'initial' => 'required|string|max:10',
            'name' => 'required|string|max:100',
        ]);

        try {
            $department = Department::findOrFail($id);
            Log::info('Department found: ' . $department->name);
            $department->name = $request->name;
            $department->initial = $request->initial;

            $department->save();

            LogHelper::record('success','update', 'Department', $department->id, 'Department updated successfully.');

            return redirect()->route('page.department.index')->with('success', 'Department updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update department: ' . $e->getMessage());
            LogHelper::record('error', 'update', 'Department', $id, $e->getMessage(), $request->all());
            $errorMessage = 'An error occurred while updating department data, please contact the administrator to see the logs.';
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();

            LogHelper::record('success', 'delete', 'Department', $department->id, 'Department deleted successfully.');

            return redirect()->route('page.department.index')
                ->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete department: ' . $e->getMessage());
            LogHelper::record('error', 'delete', 'Department', $id, $e->getMessage(), ['id' => $id]);
            return redirect()->route('page.department.index')
                ->with('error', 'An error occurred while deleting department data, ' . $e->getMessage());
        }
    }
}
