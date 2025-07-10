<?php

namespace App\Http\Controllers;

use App\Models\Kolekte;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class KolekteController extends Controller
{
    public function index()
    {
        $kolektes = Kolekte::with('jadwalIbadah')->latest()->paginate(10);
        return view('kolekte.index', compact('kolektes'));
    }

    public function create()
    {
        $jadwalIbadahs = JadwalIbadah::with('jenisIbadah')->get();
        return view('kolekte.create', compact('jadwalIbadahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_ibadah_id' => 'nullable|exists:jadwal_ibadah,id',
            'tanggal_ibadah' => 'required|date',
            'pembangunan_gereja' => 'required|numeric|min:0',
            'persembahan_pelayanan_pengerja' => 'required|numeric|min:0',
            'persembahan_pelayanan_sosial_gereja' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        Kolekte::create($request->all());

        return redirect()->route('kolekte.index')
            ->with('success', 'Data kolekte berhasil ditambahkan.');
    }

    public function show(Kolekte $kolekte)
    {
        return view('kolekte.show', compact('kolekte'));
    }

    public function edit(Kolekte $kolekte)
    {
        $jadwalIbadahs = JadwalIbadah::with('jenisIbadah')->get();
        return view('kolekte.edit', compact('kolekte', 'jadwalIbadahs'));
    }

    public function update(Request $request, Kolekte $kolekte)
    {
        $request->validate([
            'jadwal_ibadah_id' => 'nullable|exists:jadwal_ibadah,id',
            'tanggal_ibadah' => 'required|date',
            'pembangunan_gereja' => 'required|numeric|min:0',
            'persembahan_pelayanan_pengerja' => 'required|numeric|min:0',
            'persembahan_pelayanan_sosial_gereja' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $kolekte->update($request->all());

        return redirect()->route('kolekte.index')
            ->with('success', 'Data kolekte berhasil diperbarui.');
    }

    public function destroy(Kolekte $kolekte)
    {
        $kolekte->delete();

        return redirect()->route('kolekte.index')
            ->with('success', 'Data kolekte berhasil dihapus.');
    }
}
