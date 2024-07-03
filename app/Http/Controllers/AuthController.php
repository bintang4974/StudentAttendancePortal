<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function processlogin(Request $request)
    {
        // $pass = 12345678;
        // echo Hash::make($pass);
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            echo "gagal";
        }
    }
}
