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
        // menentukan latitude & longitude kantor
        $latitudeKantor = -7.2565280548557825;
        $longitudeKantor = 112.7375558738815;
        $location = $request->lokasi;
        $locationUser = explode(',', $location);
        $latitudeUser = $locationUser[0];
        $longitudeUser = $locationUser[1];

        $jarak = $this->distance($latitudeKantor, $longitudeKantor, $latitudeUser, $longitudeUser);
        $radius = round($jarak['meters']);

        // query untuk mendapatkan absen pada hari ini
        $check = DB::table('attendances')->where('date', $date)->where('student_id', $student_id)->count();
        if ($check > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }
        $image = $request->image;
        $folderPath = 'public/uploads/absensi';
        $formatName = $student_id . '-' . $date . "-" . $ket;
        $image_parts = explode(';base64', $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        if ($radius > 15000) {
            echo "error|maaf anda berada diluar radius";
        } else {
            // pengkondisian jika user sudah absen
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
                // pengkondisian ketika user belum absen
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

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}
