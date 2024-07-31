<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::query();
        $query->select('students.*', 'departments.name as name_department');
        $query->join('departments', 'students.department_id', '=', 'departments.id',);
        $query->orderBy('name');
        if (!empty($request->name_student)) {
            $query->where('students.name', 'like', '%' . $request->name_student . '%');
        }
        if (!empty($request->name_dept)) {
            $query->where('departments.name', $request->name_dept);
        }
        $student = $query->paginate(1);
        $department = Department::all();
        $mentor = Mentor::all();

        return view('student.index', compact('student', 'department', 'mentor'));
    }

    public function store(Request $request)
    {
        $pass = 12345678;
        $name = $request->name;
        $nim = $request->nim;
        $email = $request->email;
        $password = Hash::make($pass);
        $phone = $request->phone;
        $university = $request->university;
        $gender = $request->gender;
        $city = $request->city;
        $address = $request->address;
        // $photo = $request->photo;
        $department_id = $request->department_id;
        $mentor_id = $request->mentor_id;
        // $student = DB::table('students')->where('id', $nim)->first();

        if ($request->hasFile('photo')) {
            $photo = $nim . "." . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = null;
        }

        try {
            $data = [
                'name' => $name,
                'nim' => $nim,
                'email' => $email,
                'password' => $password,
                'phone' => $phone,
                'university' => $university,
                'gender' => $gender,
                'city' => $city,
                'address' => $address,
                'photo' => $photo,
                'department_id' => $department_id,
                'mentor_id' => $mentor_id,
            ];
            $save = DB::table('students')->insert($data);
            if($save){
                if ($request->hasFile('photo')) {
                    $folderPath = 'public/uploads/student/';
                    $request->file('photo')->storeAs($folderPath, $photo);
                }
                return Redirect::back()->with(['success' => 'Success Store!']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['error' => 'Failed Store!']);
        }
    }
}
