<?php

namespace App\Http\Controllers;

use App\Models\WartaGereja;
use Illuminate\Http\Request;

class WartaGerejaController extends Controller
{
    /**
     * menampilkan daftar warta gereja
     */
    public function index()
    {
        $data = WartaGereja::all()->sortByDesc('tanggal');
        return view('halaman.warta-gereja.index', compact('data'));
    }

    /**
     * mampilkan form untuk menambahkan warta gereja
     */
    public function create()
    {
        return view('halaman.warta-gereja.tambah');
    }

    /**
     * menyimpan warta gereja baru
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_warta' => 'required|max:60',
            'tanggal' => 'required|date',
            'warta' => 'required',
        ], [
            'nama_warta.required' => 'Nama warta gereja harus diisi.',
            'nama_warta.max' => 'Nama warta gereja maksimal 60 karakter.',
            'tanggal.required' => 'Tanggal warta gereja harus diisi.',
            'tanggal.date' => 'Tanggal warta gereja harus berupa tanggal yang valid.',
            'warta.required' => 'Konten warta gereja harus diisi.',
        ]);

        try {
            WartaGereja::create($request->all());
            return redirect()->route('warta-gereja.index')->with('success', 'Warta gereja berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan warta gereja: ' . $e->getMessage()]);
        }
    }

    /**
     * menampilkan data warta berdasarkan id.
     */
    public function show(string $id)
    {
        $data = WartaGereja::findOrFail($id);
        return view('halaman.warta-gereja.detail', compact('data'));
    }

    /**
     * menampilkan form untuk mengedit warta gereja
     */
    public function edit($id)
    {
        $data = WartaGereja::findOrFail($id);
        return view('halaman.warta-gereja.edit', compact('data'));
    }

    /**
     * mengupdate warta gereja yang sudah ada
     */
    public function update(Request $request, string $id)
    {
        $validasi = $request->validate([
            'nama_warta' => 'required|max:60',
            'tanggal' => 'required|date',
            'warta' => 'required',
        ], [
            'nama_warta.required' => 'Nama warta gereja harus diisi.',
            'nama_warta.max' => 'Nama warta gereja maksimal 60 karakter.',
            'tanggal.required' => 'Tanggal warta gereja harus diisi.',
            'tanggal.date' => 'Tanggal warta gereja harus berupa tanggal yang valid.',
            'warta.required' => 'Konten warta gereja harus diisi.',
        ]);

        try {
            $wartaGereja = WartaGereja::findOrFail($id);
            $wartaGereja->update($request->all());
            return redirect()->route('warta-gereja.index')->with('success', 'Warta gereja berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui warta gereja: ' . $e->getMessage()]);
        }
    }

    /**
     * menghapus warta gereja berdasarkan id.
     */
    public function destroy(string $id)
    {
        try {
            $wartaGereja = WartaGereja::findOrFail($id);
            $wartaGereja->delete();
            return redirect()->route('warta-gereja.index')->with('success', 'Warta gereja berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus warta gereja: ' . $e->getMessage()]);
        }
    }
}
