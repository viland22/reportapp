<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PlanningController;

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user', [UserController::class, 'index'])->name('page.user.index')->middleware('role:admin');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('page.user.edit')->middleware('role:admin');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('page.user.update')->middleware('role:admin');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('page.user.destroy')->middleware('role:admin');
    Route::get('/user/create', [UserController::class, 'create'])->name('page.user.create')->middleware('role:admin');
    Route::post('/user/store', [UserController::class, 'store'])->name('page.user.store')->middleware('role:admin');
    Route::get('/user/trash', [UserController::class, 'trash'])->name('page.user.trash')->middleware('role:admin');
    Route::get('/user/restore/{id}', [UserController::class, 'restore'])->name('page.user.restore')->middleware('role:admin');
    Route::get('/user/force-delete/{id}', [UserController::class, 'forceDelete'])->name('page.user.forceDelete')->middleware('role:admin');
    Route::get('/client', [ClientController::class, 'index'])->name('page.client.index')->middleware('role:admin');

    Route::get('/department', [DepartmentController::class, 'index'])->name('page.department.index')->middleware('role:admin');
    Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('page.department.edit')->middleware('role:admin');
    Route::put('/department/update/{id}', [DepartmentController::class, 'update'])->name('page.department.update')->middleware('role:admin');
    Route::delete('/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('page.department.destroy')->middleware('role:admin');
    Route::get('/department/create', [DepartmentController::class, 'create'])->name('page.department.create')->middleware('role:admin');
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('page.department.store')->middleware('role:admin');

    Route::get('/planning', [PlanningController::class, 'index'])->name('page.planning.index')->middleware('role:admin,ppic');
    Route::get('/planning/edit/{id}', [PlanningController::class, 'edit'])->name('page.planning.edit')->middleware('role:admin,ppic');
    Route::put('/planning/update/{id}', [PlanningController::class, 'update'])->name('page.planning.update')->middleware('role:admin,ppic');
    Route::delete('/planning/delete/{id}', [PlanningController::class, 'destroy'])->name('page.planning.destroy')->middleware('role:admin,ppic');
    Route::get('/planning/create', [PlanningController::class, 'create'])->name('page.planning.create')->middleware('role:admin,ppic');
    Route::post('/planning/store', [PlanningController::class, 'store'])->name('page.planning.store')->middleware('role:admin,ppic');

    Route::get('/log', [LogController::class, 'index'])->name('page.log.index')->middleware('role:admin');
});
Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);
