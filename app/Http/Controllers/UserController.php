<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Helpers\LogHelper;

class UserController extends Controller
{
    public function index()
    {
        $userall = User::with(['role', 'department'])->get();
        //Log::info($userall);
        return view('page.user.index', compact('userall'));
    }

    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('page.user.create', compact('roles', 'departments'));
    }

    public function store(Request $request)
    {
        //Log::info('Membuat user dengan data: ' . json_encode($request->all()));
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6',
            'department_id' => 'required|exists:departments,id',
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password),
                'department_id' => $request->department_id,
            ]);

            LogHelper::record('success', 'create', 'User', $user->id, 'User added successfully.');
            return redirect()->route('page.user.index')->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            Log::error('Gagal membuat user: ' . $e->getMessage());
            LogHelper::record('error', 'create', 'User', null, $e->getMessage(), $request->all());
            $errorMessage = 'An error occurred while adding user data, please contact the administrator to see the logs.';
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function edit($id)
    {
        //Log::info($id);
        $userSelected = User::findOrFail($id);
        //Log::info($userSelected);
        $roles = Role::all();
        $departments = Department::all();
        return view('page.user.edit', compact('userSelected', 'roles', 'departments'));
    }

    public function update(Request $request, $id)
    {
        Log::info($request->all());
        Log::info($id);
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'role_id' => 'required|exists:roles,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        try {
            $user = User::findOrFail($id);
            Log::info('User found: ' . $user->name);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->department_id = $request->department_id;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            LogHelper::record('success', 'update', 'User', $user->id, 'User updated successfully.');
            return redirect()->route('page.user.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update user: ' . $e->getMessage());
            LogHelper::record('error', 'update', 'User', $id, $e->getMessage(), $request->all());
            $errorMessage = 'An error occurred while updating user data, please contact the administrator to see the logs.';
            return redirect()->back()->withInput()->with('error', $errorMessage);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            LogHelper::record('success', 'delete', 'User', $user->id, 'User deleted successfully.');
            return redirect()->route('page.user.index')
                ->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete user: ' . $e->getMessage());
            LogHelper::record('error', 'delete', 'User', $id, $e->getMessage(), ['id' => $id]);
            return redirect()->route('page.user.index')
                ->with('error', 'An error occurred while deleting user data, ' . $e->getMessage());
        }
    }


    // Optional: lihat data terhapus
    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('page.user.trash', compact('users'));
    }

    // Restore
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('page.user.index')->with('success', 'User restored.');
    }

    // Permanent delete
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('page.user.index')->with('success', 'User permanently deleted.');
    }
}
