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
        return view('attendance.create');
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
        $data = [
            'student_id' => $student_id,
            'date' => $date,
            'time_in' => $time,
            'photo_in' => $fileName,
            'location_in' => $location
        ];
        // Attendance::create($data);
        $save = DB::table('attendances')->insert($data);
        if ($save) {
            echo 0;
            Storage::put($file, $image_base64);
        } else {
            echo 1;
        }
    }
}
