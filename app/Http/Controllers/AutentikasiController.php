<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
            if (Auth::user()->hak_akses_id == 1) {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->route('home')->with('success', 'Anda berhasil masuk sebagai ' . Auth::user()->name);
            }
        }

        return back()->withErrors([
            'message' => 'Email atau password salah.',
        ]);
    }

    public function dashboard() {
        $users = User::all();
        $dataPengguna = $users->count();
        $dataTamu = $users->where('hak_akses_id', 3)->count();
        $dataAdmin = $users->where('hak_akses_id', 1)->count();

        $jemaat = Jemaat::with('sekolahMinggu', 'remaja')
            ->orderBy('nama_keluarga')
            ->get();

        // Menghitung total anggota keluarga
        foreach ($jemaat as $j) {
            $j->total_anggota = 2 + $j->sekolahMinggu->count() + $j->remaja->count();
        }

        $totalJemaat = $jemaat->sum('total_anggota');

        return view('admin.dashboard', compact('dataPengguna', 'dataTamu', 'dataAdmin', 'totalJemaat'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
