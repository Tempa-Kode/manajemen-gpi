<?php

namespace App\Http\Controllers;

use App\Models\UcapanSyukur;
use Illuminate\Http\Request;

class UcapaSyukurController extends Controller
{
    public function index()
    {
        $data = UcapanSyukur::latest()->get();

        // mengambil data ucapan syukur dalam bulan ini, dan menghitung nominal
        $bulanIni = UcapanSyukur::whereMonth('created_at', now()->month)->get();
        $totalBulanIni = $bulanIni->sum('nominal');

        // mengambil data ucapan syukur dalam minggu ini (gunakan rentang tanggal untuk menghindari fungsi WEEK() yang bermasalah)
        $now = now();
        $startOfWeek = $now->copy()->startOfWeek(); // default mulai Senin; ganti jika perlu
        $endOfWeek = $now->copy()->endOfWeek();
        $mingguIni = UcapanSyukur::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
        $totalMingguIni = $mingguIni->sum('nominal');

        // mengambil data ucapan syukur dalam tahun ini
        $tahunIni = UcapanSyukur::whereYear('created_at', now()->year)->get();
        $totalTahunIni = $tahunIni->sum('nominal');

        return view(
            'halaman.ucapan-syukur.index',
            compact('data', 'totalBulanIni', 'totalMingguIni', 'totalTahunIni')
        );
    }
}
