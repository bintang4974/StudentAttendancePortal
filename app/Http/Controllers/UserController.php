<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $query = User::query();
        $query->select('*');
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        $department = $query->get();

        return view('department.index', compact('department'));
    }

    // public function store(Request $request)
    // {
    //     $data = [
    //         'name' => $request->name,
    //         'head_department' => $request->head_department,
    //     ];

    //     $save = DB::table('departments')->insert($data);
    //     if ($save) {
    //         return Redirect::back()->with(['success' => 'Success Adding Data!']);
    //     } else {
    //         return Redirect::back()->with(['error' => 'Failed Adding Data!']);
    //     }
    // }

    // public function edit(Request $request)
    // {
    //     $iddept = $request->iddept;
    //     $department = DB::table('departments')->where('id', $iddept)->first();
    //     return view('department.edit', compact('department'));
    // }

    // public function update($id, Request $request)
    // {
    //     $data = [
    //         'name' => $request->name,
    //         'head_department' => $request->head_department
    //     ];

    //     $update = DB::table('departments')->where('id', $id)->update($data);
    //     if ($update) {
    //         return Redirect::back()->with(['success' => 'Success Update Data!']);
    //     } else {
    //         return Redirect::back()->with(['error' => 'Failed Update Data!']);
    //     }
    // }

    // public function delete($id)
    // {
    //     $delete = DB::table('departments')->where('id', $id)->delete();
    //     if ($delete) {
    //         return Redirect::back()->with(['success' => 'Success Delete Data!']);
    //     } else {
    //         return Redirect::back()->with(['error' => 'Failed Delete Data!']);
    //     }
    // }
}
