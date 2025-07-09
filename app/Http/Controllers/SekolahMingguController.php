<?php

namespace App\Http\Controllers;

use App\Models\SekolahMinggu;
use App\Models\Jemaat;
use Illuminate\Http\Request;

class SekolahMingguController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SekolahMinggu::with('jemaat')->orderBy('created_at', 'desc')->get();
        return view('halaman.sekolah-minggu.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jemaat = Jemaat::orderBy('nama_keluarga')->get();
        return view('halaman.sekolah-minggu.tambah', compact('jemaat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_kk' => 'required|exists:jemaat,id',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,tidak_aktif',
        ], [
            'id_kk.required' => 'Keluarga harus dipilih.',
            'id_kk.exists' => 'Keluarga tidak ditemukan.',
            'nama.required' => 'Nama anak harus diisi.',
            'nama.max' => 'Nama anak maksimal 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
            'kelas.max' => 'Kelas maksimal 50 karakter.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus aktif atau tidak_aktif.',
        ]);

        try {
            $sekolahMinggu = SekolahMinggu::create($validasi);
            return redirect()->route('data-jemaat.show', $sekolahMinggu->jemaat->id)->with('success', 'Data anak sekolah minggu berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SekolahMinggu $sekolahMinggu)
    {
        $sekolahMinggu->load('jemaat');
        return view('halaman.sekolah-minggu.detail', compact('sekolahMinggu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SekolahMinggu $sekolahMinggu)
    {
        $jemaat = Jemaat::orderBy('nama_keluarga')->get();
        return view('halaman.sekolah-minggu.edit', compact('sekolahMinggu', 'jemaat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SekolahMinggu $sekolahMinggu)
    {
        $validasi = $request->validate([
            'id_kk' => 'required|exists:jemaat,id',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'nullable|string|max:50',
            'status' => 'required|in:aktif,tidak_aktif',
        ], [
            'id_kk.required' => 'Keluarga harus dipilih.',
            'id_kk.exists' => 'Keluarga tidak ditemukan.',
            'nama.required' => 'Nama anak harus diisi.',
            'nama.max' => 'Nama anak maksimal 255 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
            'kelas.max' => 'Kelas maksimal 50 karakter.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus aktif atau tidak_aktif.',
        ]);

        try {
            $sekolahMinggu->update($validasi);
            return redirect()->route('sekolah-minggu.show', $sekolahMinggu)->with('success', 'Data anak sekolah minggu berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SekolahMinggu $sekolahMinggu)
    {
        try {
            $nama = $sekolahMinggu->nama;
            $sekolahMinggu->delete();
            return redirect()->route('data-jemaat.show', $sekolahMinggu->jemaat->id)->with('success', "Data anak sekolah minggu {$nama} berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
