<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use App\Models\JenisIbadah;
use App\Models\Jemaat;
use Illuminate\Http\Request;

class JadwalIbadahController extends Controller
{
    public function index()
    {
        $data = JadwalIbadah::with('jenisIbadah')->get()->sortBy('tanggal', SORT_REGULAR, true)
            ->sortBy('jam', SORT_REGULAR, true);
        return view('halaman.jadwal-ibadah.index', compact('data'));
    }

    public function create()
    {
        $jenisIbadah = JenisIbadah::orderBy('jenis_ibadah')->get();
        $rumahKeluarga = Jemaat::select('nama_keluarga', 'alamat')
            ->orderBy('nama_keluarga')
            ->get();
        return view('halaman.jadwal-ibadah.tambah', compact('rumahKeluarga', 'jenisIbadah'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'jenis_ibadah_id' => 'required|exists:jenis_ibadah,id',
            'hari' => 'required|string|max:10|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'required|date',
            'jam' => ['required', 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'tempat' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
        ], [
            'jenis_ibadah_id.required' => 'Jenis ibadah harus dipilih.',
            'jenis_ibadah_id.exists' => 'Jenis ibadah yang dipilih tidak valid.',
            'hari.required' => 'Hari ibadah harus diisi.',
            'hari.in' => 'Hari ibadah harus salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, atau Minggu.',
            'tanggal.required' => 'Tanggal ibadah harus diisi.',
            'tanggal.date' => 'Tanggal ibadah harus berupa tanggal yang valid.',
            'jam.required' => 'Jam ibadah harus diisi.',
            'jam.regex' => 'Jam ibadah harus dalam format HH:MM (contoh: 09:30).',
            'tempat.required' => 'Tempat ibadah harus diisi.',
            'tempat.max' => 'Tempat ibadah maksimal 255 karakter.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
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
        $jenisIbadah = JenisIbadah::orderBy('jenis_ibadah')->get();
        $rumahKeluarga = Jemaat::select('nama_keluarga', 'alamat')
            ->orderBy('nama_keluarga')
            ->get();
        return view('halaman.jadwal-ibadah.edit', compact('data', 'rumahKeluarga', 'jenisIbadah'));
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'jenis_ibadah_id' => 'required|exists:jenis_ibadah,id',
            'hari' => 'required|string|max:10|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'required|date',
            'jam' => ['required', 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'],
            'tempat' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
        ], [
            'jenis_ibadah_id.required' => 'Jenis ibadah harus dipilih.',
            'jenis_ibadah_id.exists' => 'Jenis ibadah yang dipilih tidak valid.',
            'hari.required' => 'Hari ibadah harus diisi.',
            'hari.in' => 'Hari ibadah harus salah satu dari: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, atau Minggu.',
            'tanggal.required' => 'Tanggal ibadah harus diisi.',
            'tanggal.date' => 'Tanggal ibadah harus berupa tanggal yang valid.',
            'jam.required' => 'Jam ibadah harus diisi.',
            'jam.regex' => 'Jam ibadah harus dalam format HH:MM (contoh: 09:30).',
            'tempat.required' => 'Tempat ibadah harus diisi.',
            'tempat.max' => 'Tempat ibadah maksimal 255 karakter.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
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
        $data = JadwalIbadah::with(['pendaftarIbadah.user', 'jenisIbadah'])->findOrFail($id);
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
