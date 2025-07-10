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

        // Data untuk statistik tambahan
        $totalSekolahMinggu = \App\Models\SekolahMinggu::count();
        $totalRemaja = \App\Models\Remaja::count();
        $totalJadwalIbadah = \App\Models\JadwalIbadah::count();
        $totalPendaftaranIbadah = \App\Models\PendaftaranIbadah::count();

        // Data kolekte (6 bulan terakhir)
        $kolekteData = \App\Models\Kolekte::selectRaw('
                YEAR(tanggal_ibadah) as tahun,
                MONTH(tanggal_ibadah) as bulan,
                SUM(pembangunan_gereja) as total_pembangunan,
                SUM(persembahan_pelayanan_pengerja) as total_pengerja,
                SUM(persembahan_pelayanan_sosial_gereja) as total_sosial
            ')
            ->where('tanggal_ibadah', '>=', now()->subMonths(6))
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        // Data pendaftaran ibadah per jenis
        $pendaftaranPerJenis = \App\Models\PendaftaranIbadah::join('jadwal_ibadah', 'pendaftaran_ibadah.jadwal_ibadah_id', '=', 'jadwal_ibadah.id')
            ->join('jenis_ibadah', 'jadwal_ibadah.jenis_ibadah_id', '=', 'jenis_ibadah.id')
            ->selectRaw('jenis_ibadah.jenis_ibadah, COUNT(*) as total')
            ->groupBy('jenis_ibadah.id', 'jenis_ibadah.jenis_ibadah')
            ->get();

        // Data kolekte bulan ini
        $kolekteBulanIni = \App\Models\Kolekte::whereMonth('tanggal_ibadah', now()->month)
            ->whereYear('tanggal_ibadah', now()->year)
            ->selectRaw('
                SUM(pembangunan_gereja) as total_pembangunan,
                SUM(persembahan_pelayanan_pengerja) as total_pengerja,
                SUM(persembahan_pelayanan_sosial_gereja) as total_sosial
            ')
            ->first();

        // Data pendaftaran ibadah bulan ini
        $pendaftaranBulanIni = \App\Models\PendaftaranIbadah::join('jadwal_ibadah', 'pendaftaran_ibadah.jadwal_ibadah_id', '=', 'jadwal_ibadah.id')
            ->whereMonth('jadwal_ibadah.tanggal', now()->month)
            ->whereYear('jadwal_ibadah.tanggal', now()->year)
            ->count();

        return view('admin.dashboard', compact(
            'dataPengguna',
            'dataTamu',
            'dataAdmin',
            'totalJemaat',
            'totalSekolahMinggu',
            'totalRemaja',
            'totalJadwalIbadah',
            'totalPendaftaranIbadah',
            'kolekteData',
            'pendaftaranPerJenis',
            'kolekteBulanIni',
            'pendaftaranBulanIni'
        ));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
