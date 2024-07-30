<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('student.index', compact('student', 'department'));
    }
}
