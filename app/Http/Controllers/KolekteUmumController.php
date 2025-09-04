<?php

namespace App\Http\Controllers;

use App\Models\KolekteUmum;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class KolekteUmumController extends Controller
{
    public function index()
    {
        $data = KolekteUmum::latest()->get();

        // mengambil kolekte umum dalam bulan ini
        $bulanIni = KolekteUmum::whereMonth('created_at', now()->month)->get();
        $totalBulanIni = $bulanIni->sum('nominal');

        // mengambil data kolekte umum dalam minggu ini
        $now = now();
        $startOfWeek = $now->copy()->startOfWeek(); // default mulai Senin; ganti jika perlu
        $endOfWeek = $now->copy()->endOfWeek();
        $mingguIni = KolekteUmum::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
        $totalMingguIni = $mingguIni->sum('nominal');

        // mengambil data ucapan syukur dalam tahun ini
        $tahunIni = KolekteUmum::whereYear('created_at', now()->year)->get();
        $totalTahunIni = $tahunIni->sum('nominal');

        return view('halaman.kolekte-umum.index',
            compact('data', 'totalBulanIni', 'totalMingguIni', 'totalTahunIni')
        );
    }

    public function create()
    {
        $jadwalIbadah = JadwalIbadah::with('jenisIbadah')
            ->whereHas('jenisIbadah', function (Builder $query) {
                $query->where('jenis_ibadah', '!=', 'Ibadah Minggu Raya');
            })->get();
        return view('halaman.kolekte-umum.tambah', compact('jadwalIbadah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_ibadah_id' => 'required|exists:jadwal_ibadah,id',
            'nominal' => 'required|numeric|min:0',
        ]);

        KolekteUmum::create($request->all());

        return redirect()->route('kolekte-umum.index')->with('success', 'Data kolekte umum berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kolekte = KolekteUmum::findOrFail($id);
        $jadwalIbadah = JadwalIbadah::with('jenisIbadah')->get();
        return view('halaman.kolekte-umum.edit', compact('kolekte', 'jadwalIbadah'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jadwal_ibadah_id' => 'nullable|exists:jadwal_ibadah,id',
            'nominal' => 'required|numeric|min:0',
        ]);

        $kolekte = KolekteUmum::findOrFail($id);
        $kolekte->update($request->all());

        return redirect()->route('kolekte-umum.index')->with('success', 'Data kolekte umum berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kolekte = KolekteUmum::findOrFail($id);
        $kolekte->delete();

        return redirect()->route('kolekte-umum.index')->with('success', 'Data kolekte umum berhasil dihapus.');
    }
}
