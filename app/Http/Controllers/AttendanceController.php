<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\select;

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
        $time = date('H:i:s');

        $data = [
            'student_id' => $student_id,
            'date' => $date,
            'status' => $status,
            'description' => $description,
            'status_approved' => $status_approved,
        ];
        $dataAtt = [
            'student_id' => $student_id,
            'date' => $request->date,
            'time_in' => $time,
            'time_out' => null,
            'photo_in' => null,
            'photo_out' => null,
            'location_in' => null,
            'location_out' => null,
        ];

        $saveAtt = DB::table('attendances')->insert($dataAtt);
        $save = DB::table('permissions')->insert($data);
        if ($save && $saveAtt) {
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

    public function showmap(Request $request)
    {
        $id = $request->id;
        $attendance = DB::table('attendances')
            ->where('attendances.id', $id)
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->first();
        return view('attendance.showmap', compact('attendance'));
    }

    public function report()
    {
        $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $student = DB::table('students')->orderBy('name')->get();
        return view('attendance.report', compact('namemonth', 'student'));
    }

    public function printreport(Request $request)
    {
        $student_id = $request->student_id;
        $month = $request->month;
        $year = $request->year;
        $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $student = DB::table('students')
            ->select('students.*', 'positions.name as position_name', 'departments.name as department_name')
            ->where('students.id', $student_id)
            ->join('departments', 'students.department_id', '=', 'departments.id')
            ->join('positions', 'students.position_id', '=', 'positions.id')
            ->first();

        // query menampilkan absensi user berdasarkan bulan yang dipilih
        $attendance = DB::table('attendances')
            ->select('attendances.*', 'students.activity_id as activity_id', 'permissions.date as permis_date')
            ->where('students.id', $student_id)
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->leftJoin('permissions', function ($join) {
                $join->on('students.id', '=', 'permissions.student_id')
                    ->whereRaw('permissions.date = attendances.date');
            })
            ->whereRaw('MONTH(attendances.date)="' . $month . '"')
            ->whereRaw('YEAR(attendances.date)="' . $year . '"')
            ->orderBy('attendances.date')
            ->get();
        // dd($attendance);

        if (isset($_POST['exportexcel'])) {
            $time = date('d-m-Y H:i:s');
            header("content-type: application/vnd-ms-excel");
            header("content-Disposition: attachment; filename=Laporan Presensi Mahasiswa $time.xls");
            return view('attendance.printreportexcel', compact('month', 'year', 'namemonth', 'student', 'attendance'));
        }

        return view('attendance.printreport', compact('month', 'year', 'namemonth', 'student', 'attendance'));
    }

    public function recap()
    {
        $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('attendance.recap', compact('namemonth'));
    }

    public function printrecap(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $namemonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $recap = DB::table('attendances')
            ->selectRaw('students.activity_id AS activity_id, students.name AS student_name, 
                MAX(IF(DAY(attendances.date) = 1, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_1,
                MAX(IF(DAY(attendances.date) = 2, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_2,
                MAX(IF(DAY(attendances.date) = 3, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_3,
                MAX(IF(DAY(attendances.date) = 4, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_4,
                MAX(IF(DAY(attendances.date) = 5, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_5,
                MAX(IF(DAY(attendances.date) = 6, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_6,
                MAX(IF(DAY(attendances.date) = 7, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_7,
                MAX(IF(DAY(attendances.date) = 8, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_8,
                MAX(IF(DAY(attendances.date) = 9, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_9,
                MAX(IF(DAY(attendances.date) = 10, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_10,
                MAX(IF(DAY(attendances.date) = 11, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_11,
                MAX(IF(DAY(attendances.date) = 12, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_12,
                MAX(IF(DAY(attendances.date) = 13, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_13,
                MAX(IF(DAY(attendances.date) = 14, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_14,
                MAX(IF(DAY(attendances.date) = 15, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_15,
                MAX(IF(DAY(attendances.date) = 16, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_16,
                MAX(IF(DAY(attendances.date) = 17, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_17,
                MAX(IF(DAY(attendances.date) = 18, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_18,
                MAX(IF(DAY(attendances.date) = 19, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_19,
                MAX(IF(DAY(attendances.date) = 20, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_20,
                MAX(IF(DAY(attendances.date) = 21, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_21,
                MAX(IF(DAY(attendances.date) = 22, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_22,
                MAX(IF(DAY(attendances.date) = 23, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_23,
                MAX(IF(DAY(attendances.date) = 24, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_24,
                MAX(IF(DAY(attendances.date) = 25, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_25,
                MAX(IF(DAY(attendances.date) = 26, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_26,
                MAX(IF(DAY(attendances.date) = 27, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_27,
                MAX(IF(DAY(attendances.date) = 28, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_28,
                MAX(IF(DAY(attendances.date) = 29, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_29,
                MAX(IF(DAY(attendances.date) = 30, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_30,
                MAX(IF(DAY(attendances.date) = 31, CONCAT(time_in,"-",IFNULL(time_out,"00:00:00")),"")) AS tgl_31')
            // ->select('attendances.*')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->leftJoin('permissions', function ($join) {
                $join->on('students.id', '=', 'permissions.student_id')
                    ->whereRaw('permissions.date = attendances.date');
            })
            ->whereRaw('MONTH(attendances.date)="' . $month . '"')
            ->whereRaw('YEAR(attendances.date)="' . $year . '"')
            ->groupByRaw('activity_id, student_name')
            ->get();
        // dd($recap);

        if (isset($_POST['exportexcel'])) {
            $time = date('d-m-Y H:i:s');
            header("content-type: application/vnd-ms-excel");
            header("content-Disposition: attachment; filename=Rekap Presensi $time.xls");
        }

        return view('attendance.printrecap', compact('month', 'year', 'namemonth', 'recap'));
    }

    public function izinsakit(Request $request)
    {
        $query = Permission::query();
        $query->select('permissions.*', 'students.activity_id as activity_id', 'students.name as student_name', 'departments.name as dept_name', 'positions.name as position_name');
        $query->join('students', 'permissions.student_id', '=', 'students.id');
        $query->join('departments', 'students.department_id', '=', 'departments.id');
        $query->join('positions', 'students.position_id', '=', 'positions.id');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('date', [$request->dari, $request->sampai]);
        }
        if (!empty($request->activity_id)) {
            $query->where('activity_id', $request->activity_id);
        }
        if (!empty($request->student_name)) {
            $query->where('students.name', 'like', '%' . $request->student_name . '%');
        }
        if ($request->status_approved === "0" || $request->status_approved === "1" || $request->status_approved === "2") {
            $query->where('status_approved', $request->status_approved);
        }
        $query->orderBy('date', 'desc');
        $izinsakit = $query->paginate(10);
        $izinsakit->appends($request->all());

        return view('attendance.izinsakit', compact('izinsakit'));
    }

    public function approvedizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('permissions')->where('id', $id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Success Update!']);
        } else {
            return Redirect::back()->with(['error' => 'Failed Update!']);
        }
    }

    public function cancelizinsakit($id)
    {
        $update = DB::table('permissions')->where('id', $id)->update([
            'status_approved' => 0
        ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Success Update!']);
        } else {
            return Redirect::back()->with(['error' => 'Failed Update!']);
        }
    }

    public function checkpermission(Request $request)
    {
        $date_permis = $request->date;
        $student_id = Auth::guard('student')->user()->id;
        $check = DB::table('permissions')->where('student_id', $student_id)->where('date', $date_permis)->count();
        return $check;
    }
}
