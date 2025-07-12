<?php

namespace App\Http\Controllers;

use App\Models\Remaja;
use App\Models\Jemaat;
use Illuminate\Http\Request;

class RemajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Remaja::with('jemaat')->orderBy('created_at', 'desc')->get();
        return view('halaman.remaja.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jemaat = Jemaat::orderBy('nama_keluarga')->get();
        return view('halaman.remaja.tambah', compact('jemaat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_kk' => 'required|exists:jemaat,id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
        ], [
            'id_kk.required' => 'Keluarga harus dipilih.',
            'id_kk.exists' => 'Keluarga tidak ditemukan.',
            'nama.required' => 'Nama remaja harus diisi.',
            'nama.max' => 'Nama remaja maksimal 255 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
            'pendidikan.max' => 'Pendidikan maksimal 100 karakter.',
            'pekerjaan.max' => 'Pekerjaan maksimal 100 karakter.',
        ]);

        try {
            $remaja = Remaja::create($validasi);
            return redirect()->route('data-jemaat.show', $remaja->jemaat->id)->with('success', 'Data remaja berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Remaja $remaja)
    {
        $remaja->load('jemaat');
        return view('halaman.remaja.detail', compact('remaja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Remaja $remaja)
    {
        $jemaat = Jemaat::orderBy('nama_keluarga')->get();
        return view('halaman.remaja.edit', compact('remaja', 'jemaat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Remaja $remaja)
    {
        $validasi = $request->validate([
            'id_kk' => 'required|exists:jemaat,id',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
        ], [
            'id_kk.required' => 'Keluarga harus dipilih.',
            'id_kk.exists' => 'Keluarga tidak ditemukan.',
            'nama.required' => 'Nama remaja harus diisi.',
            'nama.max' => 'Nama remaja maksimal 255 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
            'pendidikan.max' => 'Pendidikan maksimal 100 karakter.',
            'pekerjaan.max' => 'Pekerjaan maksimal 100 karakter.',
        ]);

        try {
            $remaja->update($validasi);
            return redirect()->route('remaja.show', $remaja)->with('success', 'Data remaja berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Remaja $remaja)
    {
        try {
            $nama = $remaja->nama;
            $remaja->delete();
            return redirect()->route('data-jemaat.show', $remaja->jemaat)->with('success', "Data remaja {$nama} berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
