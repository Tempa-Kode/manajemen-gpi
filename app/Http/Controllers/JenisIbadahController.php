<?php

namespace App\Http\Controllers;

use App\Models\JenisIbadah;
use Illuminate\Http\Request;

class JenisIbadahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisIbadah = JenisIbadah::withCount('jadwalIbadah')->paginate(10);
        return view('halaman.jenis-ibadah.index', compact('jenisIbadah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('halaman.jenis-ibadah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_ibadah' => 'required|string|max:100|unique:jenis_ibadah,jenis_ibadah'
        ], [
            'jenis_ibadah.required' => 'Jenis ibadah wajib diisi',
            'jenis_ibadah.max' => 'Jenis ibadah maksimal 100 karakter',
            'jenis_ibadah.unique' => 'Jenis ibadah sudah ada'
        ]);

        JenisIbadah::create($request->only(['jenis_ibadah']));

        return redirect()->route('jenis-ibadah.index')
            ->with('success', 'Jenis ibadah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisIbadah $jenisIbadah)
    {
        $jenisIbadah->load(['jadwalIbadah' => function($query) {
            $query->orderBy('tanggal', 'desc');
        }]);

        return view('halaman.jenis-ibadah.show', compact('jenisIbadah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisIbadah $jenisIbadah)
    {
        return view('halaman.jenis-ibadah.edit', compact('jenisIbadah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisIbadah $jenisIbadah)
    {
        $request->validate([
            'jenis_ibadah' => 'required|string|max:100|unique:jenis_ibadah,jenis_ibadah,' . $jenisIbadah->id
        ], [
            'jenis_ibadah.required' => 'Jenis ibadah wajib diisi',
            'jenis_ibadah.max' => 'Jenis ibadah maksimal 100 karakter',
            'jenis_ibadah.unique' => 'Jenis ibadah sudah ada'
        ]);

        $jenisIbadah->update($request->only(['jenis_ibadah']));

        return redirect()->route('jenis-ibadah.index')
            ->with('success', 'Jenis ibadah berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisIbadah $jenisIbadah)
    {
        // Cek apakah ada jadwal ibadah yang menggunakan jenis ibadah ini
        if ($jenisIbadah->jadwalIbadah()->count() > 0) {
            return redirect()->route('jenis-ibadah.index')
                ->with('error', 'Jenis ibadah tidak dapat dihapus karena masih digunakan pada jadwal ibadah');
        }

        $jenisIbadah->delete();

        return redirect()->route('jenis-ibadah.index')
            ->with('success', 'Jenis ibadah berhasil dihapus');
    }
}
