<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MentorController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $user = User::all();
        $query = Mentor::query();
        $query->select('*');
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        $mentor = $query->get();

        return view('mentor.index', compact('mentor', 'user'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name_mentor,
            'phone' => $request->phone,
            'user_id' => $request->user_id,
        ];

        $save = DB::table('mentors')->insert($data);
        if ($save) {
            return Redirect::back()->with(['success' => 'Success Adding Data!']);
        } else {
            return Redirect::back()->with(['error' => 'Failed Adding Data!']);
        }
    }

    public function edit(Request $request)
    {
        $idmentor = $request->idmentor;
        $user = User::all();
        $mentor = DB::table('mentors')->where('id', $idmentor)->first();

        return view('mentor.edit', compact('mentor', 'user'));
    }

    public function update($id, Request $request)
    {
        $data = [
            'name' => $request->name_mentor,
            'phone' => $request->phone,
            'user_id' => $request->user_id,
        ];

        $update = DB::table('mentors')->where('id', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Success Update Data!']);
        } else {
            return Redirect::back()->with(['error' => 'Failed Update Data!']);
        }
    }

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
