<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
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
            ->orderBy('date', 'desc')
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
            ->orderBy('time_in')
            ->get();
        $nameMonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // dd($nameMonth[$thisMonth]);

        // query untuk menghitung jumlah izin dari user berdasarkan bulan yang berjalan
        $recappermission = DB::table('permissions')
            ->selectRaw('SUM(IF(status="i",1,0)) as amountpermis, SUM(IF(status="s",1,0)) as amountsick')
            ->where('student_id', $student_id)
            ->whereRaw('MONTH(date)="' . $thisMonth . '"')
            ->whereRaw('YEAR(date)="' . $thisYear . '"')
            ->where('status_approved', 1)
            ->first();
        return view('dashboard.dashboard2', compact('attendanceToday', 'historyThisMonth', 'nameMonth', 'thisMonth', 'thisYear', 'recapAttendance', 'leaderboard', 'recappermission'));
    }

    public function dashboardadmin()
    {
        $today = date('Y-m-d');
        $user = Auth::user();
        $mentorId = Mentor::where('user_id', $user->id)->value('id');

        // Query dasar untuk admin (tampilkan semua data)
        $attendanceQuery = DB::table('attendances')
            ->where('date', $today);

        $permissionQuery = DB::table('permissions')
            ->where('date', $today)
            ->where('status_approved', 1);

        // Jika role adalah mentor, filter berdasarkan mahasiswa bimbingannya
        if ($user->role === 'mentor') {
            $attendanceQuery->whereIn('student_id', function ($query) use ($mentorId) {
                $query->select('id')
                    ->from('students')
                    ->where('mentor_id', $mentorId); // Mengarah ke mentors.id
            });

            $permissionQuery->whereIn('student_id', function ($query) use ($mentorId) {
                $query->select('id')
                    ->from('students')
                    ->where('mentor_id', $mentorId); // Mengarah ke mentors.id
            });
        }

        // Eksekusi query
        $recapAttendance = $attendanceQuery
            ->selectRaw('COUNT(student_id) as jmlhadir, SUM(IF(time_in > "08:00",1,0)) as jmlterlambat')
            ->first();

        $recappermission = $permissionQuery
            ->selectRaw('SUM(IF(status="i",1,0)) as amountpermis, SUM(IF(status="s",1,0)) as amountsick')
            ->first();

        // $recapAttendance = DB::table('attendances')
        //     ->selectRaw('COUNT(student_id) as jmlhadir, SUM(IF(time_in > "08:00",1,0)) as jmlterlambat')
        //     ->where('date', $today)
        //     ->first();

        // $recappermission = DB::table('permissions')
        //     ->selectRaw('SUM(IF(status="i",1,0)) as amountpermis, SUM(IF(status="s",1,0)) as amountsick')
        //     ->where('date', $today)
        //     ->where('status_approved', 1)
        //     ->first();

        return view('dashboard.dashboardadmin', compact('recapAttendance', 'recappermission'));
    }
}
