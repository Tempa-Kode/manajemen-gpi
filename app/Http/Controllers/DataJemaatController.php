<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Remaja;
use App\Models\SekolahMinggu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = \App\Models\Jemaat::all()->sortBy('id_kk');
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
            'tanggal_pendaftaran' => 'nullable|date',
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
            'tanggal_pendaftaran.date' => 'Tanggal pendaftaran harus berupa tanggal yang valid.',
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
            'tanggal_pendaftaran' => 'nullable|date',
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
            'tanggal_pendaftaran.date' => 'Tanggal pendaftaran harus berupa tanggal yang valid.',
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
        $pdf = Pdf::loadView('halaman.data-jemaat.cetak', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream(str_replace(['/', '\\'], '_', "{$data->nama_keluarga}.pdf"));
        // return view('halaman.data-jemaat.print', compact('data'));
    }

    public function laporan(Request $request)
    {
        $data = $request->input('data');
        switch ($data) {
            case 'remaja':
                $remaja = Remaja::all();
                $pdf = Pdf::loadView('halaman.remaja.laporan', compact('remaja'));
                return $pdf->stream('data-remaja.pdf');
                break;
            case 'anak_sekolah_minggu':
                $sm = SekolahMinggu::all();
                $pdf = Pdf::loadView('halaman.sekolah-minggu.laporan', compact('sm'));
                return $pdf->stream('data-sekolah-minggu.pdf');
                break;
            default:
                $jemaat = Jemaat::with(['sekolahMinggu', 'remaja'])->get();
                $pdf = Pdf::loadView('halaman.data-jemaat.laporan', compact('jemaat'));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('data-jemaat.pdf');
                break;
        }
    }

    public function keluarDariAnggotaJemaat($id)
    {
        $data = Jemaat::findOrFail($id);
        $data->tgl_keluar = now();
        $data->save();
        return redirect()->route('data-jemaat.show', $data->id)->with('success', "Data jemaat {$data->nama_keluarga} berhasil dikeluarkan.");
    }

    /**
     * Update tanggal meninggal ayah
     */
    public function updateMeninggalAyah(Request $request, $id)
    {
        $request->validate([
            'tgl_meninggal_ayah' => 'required|date'
        ], [
            'tgl_meninggal_ayah.required' => 'Tanggal meninggal ayah harus diisi.',
            'tgl_meninggal_ayah.date' => 'Tanggal meninggal ayah harus berupa tanggal yang valid.'
        ]);

        try {
            $data = Jemaat::findOrFail($id);
            $data->tgl_meninggal_ayah = $request->tgl_meninggal_ayah;
            $data->save();
            return redirect()->route('data-jemaat.show', $data->id)->with('success', "Tanggal meninggal ayah untuk keluarga {$data->nama_keluarga} berhasil diperbarui.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui tanggal meninggal ayah: ' . $e->getMessage());
        }
    }

    /**
     * Update tanggal meninggal ibu
     */
    public function updateMeninggalIbu(Request $request, $id)
    {
        $request->validate([
            'tgl_meninggal_ibu' => 'required|date'
        ], [
            'tgl_meninggal_ibu.required' => 'Tanggal meninggal ibu harus diisi.',
            'tgl_meninggal_ibu.date' => 'Tanggal meninggal ibu harus berupa tanggal yang valid.'
        ]);

        try {
            $data = Jemaat::findOrFail($id);
            $data->tgl_meninggal_ibu = $request->tgl_meninggal_ibu;
            $data->save();
            return redirect()->route('data-jemaat.show', $data->id)->with('success', "Tanggal meninggal ibu untuk keluarga {$data->nama_keluarga} berhasil diperbarui.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui tanggal meninggal ibu: ' . $e->getMessage());
        }
    }

    /**
     * Reset tanggal meninggal ayah
     */
    public function resetMeninggalAyah($id)
    {
        try {
            $data = Jemaat::findOrFail($id);
            $data->tgl_meninggal_ayah = null;
            $data->save();
            return redirect()->route('data-jemaat.show', $data->id)->with('success', "Status ayah untuk keluarga {$data->nama_keluarga} berhasil diubah menjadi aktif.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah status ayah: ' . $e->getMessage());
        }
    }

    /**
     * Reset tanggal meninggal ibu
     */
    public function resetMeninggalIbu($id)
    {
        try {
            $data = Jemaat::findOrFail($id);
            $data->tgl_meninggal_ibu = null;
            $data->save();
            return redirect()->route('data-jemaat.show', $data->id)->with('success', "Status ibu untuk keluarga {$data->nama_keluarga} berhasil diubah menjadi aktif.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengubah status ibu: ' . $e->getMessage());
        }
    }
}
