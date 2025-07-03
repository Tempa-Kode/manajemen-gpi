<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutentikasiController extends Controller
{
    public function login() {
        return view('user.login');
    }

    public function prosesLogin(Request $request) {
        $kridensial = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($kridensial)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('home');
            }
        }

        return back()->withErrors([
            'message' => 'Email atau password salah.',
        ]);
    }

    public function dashboard() {
        return view('admin.dashboard');
    }
}
