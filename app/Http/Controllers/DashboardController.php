<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $student_id = Auth::guard('student')->user()->id;
        $attendanceToday = DB::table('attendances')->where('student_id', $student_id)->where('date', $today)->first();
        return view('dashboard.dashboard', compact('attendanceToday'));
    }
}
