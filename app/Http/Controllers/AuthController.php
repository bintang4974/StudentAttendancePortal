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
            return redirect('/')->with(['warning' => 'email/pass salah!']);
        }
    }

    public function processLogout()
    {
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
            return redirect('/');
        }
    }

    public function processloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning' => 'email/pass salah!']);
        }
    }

    public function processLogoutAdmin()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }
}
