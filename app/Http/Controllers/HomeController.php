<?php

namespace App\Http\Controllers;

use App\Models\JenisIbadah;
use App\Models\JadwalIbadah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }

    public function tentangGereja()
    {
        return view('landing.tentang-gereja');
    }

    public function jadwalPelayanan()
    {
        // Ambil tanggal awal dan akhir bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Ambil semua jenis ibadah dengan jadwal ibadah dalam bulan ini
        $jenisIbadah = JenisIbadah::with(['jadwalIbadah' => function($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
              ->orderBy('tanggal', 'asc')
              ->orderBy('jam', 'asc');
        }])->orderBy('jenis_ibadah')->get();

        // Ambil semua jadwal ibadah bulan ini untuk overview
        $jadwalBulanIni = JadwalIbadah::with('jenisIbadah')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        Carbon::setLocale('id');
        $bulanIni = Carbon::now()->translatedFormat('F Y');

        return view('landing.jadwal-pelayanan', compact('jenisIbadah', 'jadwalBulanIni', 'bulanIni'));
    }
}
