<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
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
        $folderPath = 'public/uploads/absensi/';
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

    public function editprofile()
    {
        $student_id = Auth::guard('student')->user()->id;
        $student = DB::table('students')->where('id', $student_id)->first();

        return view('attendance.editprofile', compact('student'));
    }

    public function updateprofile(Request $request)
    {
        $student_id = Auth::guard('student')->user()->id;
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $password = Hash::make($request->password);
        $student = DB::table('students')->where('id', $student_id)->first();

        if ($request->hasFile('photo')) {
            $photo = $student_id . "." . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = $student->photo;
        }

        if (empty($request->password)) {
            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'photo' => $photo
            ];
        } else {
            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'photo' => $photo,
            ];
        }

        $update = DB::table('students')->where('id', $student_id)->update($data);
        if ($update) {
            if ($request->hasFile('photo')) {
                $folderPath = 'public/uploads/student/';
                $request->file('photo')->storeAs($folderPath, $photo);
            }
            return Redirect::back()->with(['success' => 'Success Update!']);
        } else {
            return Redirect::back()->with(['error' => 'Failed Update!']);
        }
    }

    public function history()
    {
        $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('attendance.history', compact('namemonth'));
    }

    public function gethistory(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $student_id = Auth::guard('student')->user()->id;

        // mengambil history user berdasarkan bulan dan tahun
        $history = DB::table('attendances')
            ->whereRaw('MONTH(date)="' . $month . '"')
            ->whereRaw('YEAR(date)="' . $year . '"')
            ->where('student_id', $student_id)
            ->orderBy('date')
            ->get();

        return view('attendance.gethistory', compact('history'));
    }

    public function permission()
    {
        $student_id = Auth::guard('student')->user()->id;
        $permission = DB::table('permissions')->where('student_id', $student_id)->get();
        return view('attendance.permission', compact('permission'));
    }

    public function creatpermission()
    {
        return view('attendance.creatpermission');
    }

    public function storepermission(Request $request)
    {
        $student_id = Auth::guard('student')->user()->id;
        $date = $request->date;
        $status = $request->status;
        $description = $request->description;
        $status_approved = 0;

        $data = [
            'student_id' => $student_id,
            'date' => $date,
            'status' => $status,
            'description' => $description,
            'status_approved' => $status_approved,
        ];

        $save = DB::table('permissions')->insert($data);
        if ($save) {
            return redirect('/attendance/permission')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect('/attendance/permission')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function monitoring()
    {
        return view('attendance.monitoring');
    }

    public function getattendance(Request $request)
    {
        $tanggal = $request->tanggal;
        $attendance = DB::table('attendances')
            ->select('attendances.*', 'students.activity_id as activity_id', 'students.name as name_student', 'departments.name as name_department')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->join('departments', 'students.department_id', '=', 'departments.id')
            ->where('date', $tanggal)
            ->get();

        return view('attendance.getattendance', compact('attendance'));
    }
}
