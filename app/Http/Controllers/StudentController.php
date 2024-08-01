<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Mentor;
use App\Models\Position;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
        $student = $query->paginate(10);
        $department = Department::all();
        $mentor = Mentor::all();
        $position = Position::all();

        return view('student.index', compact('student', 'department', 'mentor', 'position'));
    }

    public function store(Request $request)
    {
        $nim = $request->nim;

        if ($request->hasFile('photo')) {
            $photo = $nim . "." . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = null;
        }

        try {
            $pass = 12345678;
            $data = [
                'name' => $request->name,
                'activity_id' => $request->activity_id,
                'nim' => $nim,
                'email' => $request->email,
                'password' => Hash::make($pass),
                'phone' => $request->phone,
                'university' => $request->university,
                'gender' => $request->gender,
                'placement' => $request->placement,
                'photo' => $photo,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
                'mentor_id' => $request->mentor_id,
            ];
            $save = DB::table('students')->insert($data);
            if ($save) {
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

    public function edit(Request $request)
    {
        $idmhs = $request->idmhs;
        $department = Department::all();
        $mentor = Mentor::all();
        $position = Position::all();
        $student = DB::table('students')->where('id', $idmhs)->first();
        return view('student.edit', compact('department', 'mentor', 'student', 'position'));
    }

    public function update(Request $request)
    {
        
        $id = $request->id;
        $nim = $request->nim;
        $old_photo = $request->old_photo;

        if ($request->hasFile('photo')) {
            $photo = $nim . "." . $request->file('photo')->getClientOriginalExtension();
        } else {
            $photo = $old_photo;
        }

        try {
            $pass = 12345678;
            $data = [
                'name' => $request->name,
                'activity_id' => $request->activity_id,
                // 'nim' => $nim,
                'email' => $request->email,
                'password' => Hash::make($pass),
                'phone' => $request->phone,
                'university' => $request->university,
                'gender' => $request->gender,
                'placement' => $request->placement,
                'photo' => $photo,
                'department_id' => $request->department_id,
                'position_id' => $request->position_id,
                'mentor_id' => $request->mentor_id,
            ];
            $update = DB::table('students')->where('id', $id)->update($data);
            if ($update) {
                if ($request->hasFile('photo')) {
                    $folderPath = 'public/uploads/student/';
                    $folderPathOld = 'public/uploads/student/' . $old_photo;
                    Storage::delete($folderPathOld);
                    $request->file('photo')->storeAs($folderPath, $photo);
                }
                return Redirect::back()->with(['success' => 'Success Update!']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['error' => 'Failed Update!']);
        }
    }

    public function delete($id)
    {
        $delete = DB::table('students')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Success Delete!']);
        } else {
            return Redirect::back()->with(['error' => 'Failed Delete!']);
        }
    }
}
