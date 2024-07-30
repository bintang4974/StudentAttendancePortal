<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        // $student = DB::table('students')
        //     ->orderBy('name')
        //     ->join('departments', 'student.department_id', '=', 'departments.id')
        //     ->get();
        $student = Student::paginate(1);

        return view('student.index', compact('student'));
    }
}
