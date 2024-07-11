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
        $thisMonth = date('m') * 1; // juli(7)
        $thisYear = date('Y'); //2024
        $student_id = Auth::guard('student')->user()->id;
        $attendanceToday = DB::table('attendances')->where('student_id', $student_id)->where('date', $today)->first();
        $historyThisMonth = DB::table('attendances')
            ->whereRaw('MONTH(date)="' . $thisMonth . '"')
            ->whereRaw('YEAR(date)="' . $thisYear . '"')
            ->orderBy('date')
            ->get();
        // dd($historyThisMonth);
        $nameMonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // dd($nameMonth[$thisMonth]);
        return view('dashboard.dashboard', compact('attendanceToday', 'historyThisMonth', 'nameMonth', 'thisMonth', 'thisYear'));
    }
}
