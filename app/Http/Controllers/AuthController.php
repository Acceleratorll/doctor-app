<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if (Auth::guard('patient')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('reservation/view');
        }

        return back()->with('loginError', 'Email/Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
