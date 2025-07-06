<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class JadwalIbadahController extends Controller
{
    public function index()
    {
        $data = JadwalIbadah::all()->sortBy('tanggal', SORT_REGULAR, true)
            ->sortBy('jam', SORT_REGULAR, true);
        return view('halaman.jadwal-ibadah.index', compact('data'));
    }

    public function create()
    {
        return view('halaman.jadwal-ibadah.tambah');
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'jenis_ibadah' => 'required|string|max:30',
            'hari' => 'required|string|max:10|in:Senin,Selasa,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
        ], [
            'jenis_ibadah.required' => 'Jenis ibadah harus diisi.',
            'jenis_ibadah.string' => 'Jenis ibadah harus berupa teks.',
            'jenis_ibadah.max' => 'Jenis ibadah maksimal 30 karakter.',
            'hari.required' => 'Hari ibadah harus diisi.',
            'hari.in' => 'Hari ibadah harus salah satu dari: Senin, Selasa, Rabu, kamis, Jumat, Sabtu, atau Minggu.',
            'tanggal.required' => 'Tanggal ibadah harus diisi.',
            'tanggal.date' => 'Tanggal ibadah harus berupa tanggal yang valid.',
            'jam.required' => 'Jam ibadah harus diisi.',
            'jam.date_format' => 'Jam ibadah harus dalam format HH:MM.',
        ]);

        try{
            JadwalIbadah::create($request->all());
            return redirect()->route('jadwal-ibadah.index')->with('success', 'Jadwal ibadah berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan jadwal ibadah: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $data = JadwalIbadah::findOrFail($id);
        return view('halaman.jadwal-ibadah.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'jenis_ibadah' => 'required|string|max:30',
            'hari' => 'required|string|max:10|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'required|date',
            'jam' => 'required',
        ], [
            'jenis_ibadah.required' => 'Jenis ibadah harus diisi.',
            'jenis_ibadah.string' => 'Jenis ibadah harus berupa teks.',
            'jenis_ibadah.max' => 'Jenis ibadah maksimal 30 karakter.',
            'hari.required' => 'Hari ibadah harus diisi.',
            'hari.in' => 'Hari ibadah harus salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, atau Minggu.',
            'tanggal.required' => 'Tanggal ibadah harus diisi.',
            'tanggal.date' => 'Tanggal ibadah harus berupa tanggal yang valid.',
            'jam.required' => 'Jam ibadah harus diisi.',
        ]);

        try {
            $jadwal = JadwalIbadah::findOrFail($id);
            $jadwal->update($request->all());
            return redirect()->route('jadwal-ibadah.index')->with('success', 'Jadwal ibadah berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui jadwal ibadah: ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $data = JadwalIbadah::with(['pendaftarIbadah.user'])->findOrFail($id);
        return view('halaman.jadwal-ibadah.detail', compact('data'));
    }

    public function destroy($id)
    {
        try {
            $jadwal = JadwalIbadah::findOrFail($id);
            $jadwal->delete();
            return redirect()->route('jadwal-ibadah.index')->with('success', 'Jadwal ibadah berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus jadwal ibadah: ' . $e->getMessage()]);
        }
    }
}
