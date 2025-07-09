<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use Illuminate\Http\Request;

class DataJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = \App\Models\Jemaat::all()->sortByDesc('created_at');
        return view('halaman.data-jemaat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('halaman.data-jemaat.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_kk' => 'required|numeric|unique:jemaat,id_kk',
            'nama_keluarga' => 'required|string|max:255',
            'ayah' => 'nullable|string|max:255',
            'ibu' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ], [
            'id_kk.required' => 'ID KK harus diisi.',
            'id_kk.numeric' => 'ID KK harus berupa angka.',
            'id_kk.unique' => 'ID KK sudah terdaftar.',
            'nama_keluarga.required' => 'Nama keluarga harus diisi.',
            'nama_keluarga.max' => 'Nama keluarga maksimal 255 karakter.',
            'ayah.max' => 'Nama ayah maksimal 255 karakter.',
            'ibu.max' => 'Nama ibu maksimal 255 karakter.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'no_hp.max' => 'No HP maksimal 20 karakter.',
        ]);

        try {
            $data = new Jemaat();
            $data->fill($validasi);
            $data->save();
            return redirect()->route('data-jemaat.show', $data)->with('success', 'Data jemaat berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data jemaat: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Jemaat::with(['sekolahMinggu', 'remaja'])->findOrFail($id);
        return view('halaman.data-jemaat.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Jemaat::findOrFail($id);
        return view('halaman.data-jemaat.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Jemaat::findOrFail($id);

        $validasi = $request->validate([
            'id_kk' => 'required|numeric|unique:jemaat,id_kk,' . $id,
            'nama_keluarga' => 'required|string|max:255',
            'ayah' => 'nullable|string|max:255',
            'ibu' => 'nullable|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
        ], [
            'id_kk.required' => 'ID KK harus diisi.',
            'id_kk.numeric' => 'ID KK harus berupa angka.',
            'id_kk.unique' => 'ID KK sudah terdaftar.',
            'nama_keluarga.required' => 'Nama keluarga harus diisi.',
            'nama_keluarga.max' => 'Nama keluarga maksimal 255 karakter.',
            'ayah.max' => 'Nama ayah maksimal 255 karakter.',
            'ibu.max' => 'Nama ibu maksimal 255 karakter.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'no_hp.max' => 'No HP maksimal 20 karakter.',
        ]);

        try {
            $data->update($validasi);
            return redirect()->route('data-jemaat.show', $data)->with('success', 'Data jemaat berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data jemaat: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Jemaat::findOrFail($id);
            $nama_keluarga = $data->nama_keluarga;
            $data->delete();

            return redirect()->route('data-jemaat.index')->with('success', "Data keluarga {$nama_keluarga} berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data jemaat: ' . $e->getMessage());
        }
    }

    /**
     * Print the specified resource.
     */
    public function print(string $id)
    {
        $data = Jemaat::with(['sekolahMinggu', 'remaja'])->findOrFail($id);
        return view('halaman.data-jemaat.print', compact('data'));
    }
}
