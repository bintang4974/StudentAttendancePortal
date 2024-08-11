<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:student'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/processlogin', [AuthController::class, 'processlogin']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/processloginadmin', [AuthController::class, 'processloginadmin']);
});

Route::middleware(['auth:student'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/processlogout', [AuthController::class, 'processLogout']);

    // attendance
    Route::get('/attendance/create', [AttendanceController::class, 'create']);
    Route::post('/attendance/store', [AttendanceController::class, 'store']);

    // edit profile
    Route::get('/editprofile', [AttendanceController::class, 'editprofile']);
    Route::post('/attendance/{id}/updateprofile', [AttendanceController::class, 'updateprofile']);

    // history
    Route::get('/attendance/history', [AttendanceController::class, 'history']);
    Route::post('/gethistory', [AttendanceController::class, 'gethistory']);

    // permission/izin
    Route::get('/attendance/permission', [AttendanceController::class, 'permission']);
    Route::get('/attendance/creatpermission', [AttendanceController::class, 'creatpermission']);
    Route::post('/attendance/storepermission', [AttendanceController::class, 'storepermission']);
    Route::post('/attendance/checkpermission', [AttendanceController::class, 'checkpermission']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/processlogoutadmin', [AuthController::class, 'processLogoutAdmin']);
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);

    // student
    Route::get('/student', [StudentController::class, 'index']);
    Route::post('/student/store', [StudentController::class, 'store']);
    Route::post('/student/edit', [StudentController::class, 'edit']);
    Route::post('/student/{id}/update', [StudentController::class, 'update']);
    Route::post('/student/{id}/delete', [StudentController::class, 'delete']);

    // department
    Route::get('/department', [DepartmentController::class, 'index']);
    Route::post('/department/store', [DepartmentController::class, 'store']);
    Route::post('/department/edit', [DepartmentController::class, 'edit']);
    Route::post('/department/{id}/update', [DepartmentController::class, 'update']);
    Route::post('/department/{id}/delete', [DepartmentController::class, 'delete']);

    // Monitoring Attendance
    Route::get('/attendance/monitoring', [AttendanceController::class, 'monitoring']);
    Route::post('/getattendance', [AttendanceController::class, 'getattendance']);
    Route::post('/showmap', [AttendanceController::class, 'showmap']);
    Route::get('/attendance/report', [AttendanceController::class, 'report']);
    Route::post('/attendance/printreport', [AttendanceController::class, 'printreport']);
    Route::get('/attendance/recap', [AttendanceController::class, 'recap']);
    Route::post('/attendance/printrecap', [AttendanceController::class, 'printrecap']);
    Route::get('/attendance/izinsakit', [AttendanceController::class, 'izinsakit']);
    Route::post('/attendance/approvedizinsakit', [AttendanceController::class, 'approvedizinsakit']);
    Route::get('/attendance/{id}/cancelizinsakit', [AttendanceController::class, 'cancelizinsakit']);
});
