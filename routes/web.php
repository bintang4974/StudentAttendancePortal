<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::middleware(['auth:student'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/processlogout', [AuthController::class, 'processLogout']);
    Route::get('/attendance/create', [AttendanceController::class, 'create']);
    Route::post('/attendance/store', [AttendanceController::class, 'store']);
});
