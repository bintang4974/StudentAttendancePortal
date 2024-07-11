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
        // query untuk menghitung history kehadiran peserta
        $historyThisMonth = DB::table('attendances')
            ->where('student_id', $student_id)
            ->whereRaw('MONTH(date)="' . $thisMonth . '"')
            ->whereRaw('YEAR(date)="' . $thisYear . '"')
            ->orderBy('date')
            ->get();
        // dd($historyThisMonth);

        // query untuk menghitung berapa kali kehadiran peserta berdasarkan bulan yang berjalan
        $recapAttendance = DB::table('attendances')
            ->selectRaw('COUNT(student_id) as jmlhadir, SUM(IF(time_in > "08:00",1,0)) as jmlterlambat')
            ->where('student_id', $student_id)
            ->whereRaw('MONTH(date)="' . $thisMonth . '"')
            ->whereRaw('YEAR(date)="' . $thisYear . '"')
            ->first();
        // dd($recapAttendance);

        // query untuk leaderboard yang hadir pada hari ini
        $leaderboard = DB::table('attendances')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->where('date', $today)
            ->get();
        $nameMonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // dd($nameMonth[$thisMonth]);
        return view('dashboard.dashboard', compact('attendanceToday', 'historyThisMonth', 'nameMonth', 'thisMonth', 'thisYear', 'recapAttendance', 'leaderboard'));
    }
}
