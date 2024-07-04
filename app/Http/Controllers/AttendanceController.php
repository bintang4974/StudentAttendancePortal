<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class AttendanceController extends Controller
{
    public function create()
    {
        $daynow = date('Y-m-d');
        $student_id = Auth::guard('student')->user()->id;
        $check = DB::table('attendances')->where('date', $daynow)->where('student_id', $student_id)->count();
        return view('attendance.create', compact('check'));
    }

    public function store(Request $request)
    {
        $student_id = Auth::guard('student')->user()->id;
        // alert($student_id);
        // die;
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $location = $request->lokasi;
        $image = $request->image;
        $folderPath = 'public/uploads/absensi';
        $formatName = $student_id . '-' . $date;
        $image_parts = explode(';base64', $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        // Attendance::create($data);
        $check = DB::table('attendances')->where('date', $date)->where('student_id', $student_id)->count();
        if ($check > 0) {
            $data_pulang = [
                'time_out' => $time,
                'photo_out' => $fileName,
                'location_out' => $location
            ];
            $update = DB::table('attendances')->where('date', $date)->where('student_id', $student_id)->update($data_pulang);
            if ($update) {
                echo 'success|Terimakasih, hati-hati dijalan|out';
                Storage::put($file, $image_base64);
            } else {
                echo 'error|Gagal Absensi!|out';
            }
        } else {
            $data = [
                'student_id' => $student_id,
                'date' => $date,
                'time_in' => $time,
                'photo_in' => $fileName,
                'location_in' => $location
            ];

            $save = DB::table('attendances')->insert($data);
            if ($save) {
                echo 'success|Terimakasih, Selamat Bekerja|in';
                Storage::put($file, $image_base64);
            } else {
                echo 'error|Gagal Absensi!|in';
            }
        }
    }
}
