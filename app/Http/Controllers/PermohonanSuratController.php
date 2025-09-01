<?php

namespace App\Http\Controllers;

use App\Models\IsianSurat;
use App\Models\SuratTerbit;
use Illuminate\Http\Request;
use App\Models\TemplateSurat;
use App\Models\PermohonanSurat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SuratTerbitController;

class PermohonanSuratController extends Controller
{
    public function formPermohonanSurat(Request $request)
    {
        \Carbon\Carbon::setLocale('id');
        if ($request->id) {
            $templates = TemplateSurat::where('id', $request->id)->with('isianTemplates')->first();
        } else {
            $templates = TemplateSurat::all();
        }
        $permohonan = PermohonanSurat::where('user_id', Auth::user()->id)
            ->where('status', '!=', 'selesai')
            ->with(['templateSurat'])
            ->latest()
            ->get();
        return view('landing.form-permohonan-surat', compact('templates', 'permohonan'));
    }

    public function simpanPermononanSurat(Request $request)
    {
        $validasi = $request->validate([
            'template_id' => 'required|exists:template_surat,id',
            'nama_field.*' => 'required|string',
            'isi_field.*' => 'required|string',
        ], [
            'judul_surat.required' => 'Judul surat tidak boleh kosong.',
            'nama_field.*.required' => 'Nama field tidak boleh kosong.',
            'isi_field.*.required' => 'Isi field tidak boleh kosong.',
        ]);

        DB::beginTransaction();

        try {
            $template = TemplateSurat::findOrFail($validasi['template_id']);
            $permohonan = PermohonanSurat::create([
                'template_surat_id' => $validasi['template_id'],
                'nama_pemohon' => Auth::user()->name,
                'no_telp' => Auth::user()->no_telp,
                'user_id' => Auth::user()->id
            ]);

            $suratTerbit = SuratTerbit::create([
                'permohonan_id' => $permohonan->id,
                'template_id' => $validasi['template_id'],
                'judul_surat' => $template->nama_template,
                'terbit' => 0,
            ]);

            foreach ($validasi['nama_field'] as $index => $namaField) {
                IsianSurat::create([
                    'surat_id' => $suratTerbit->id,
                    'nama_field' => $namaField,
                    'isi_field' => $validasi['isi_field'][$index],
                ]);
            }
            DB::commit();
            return redirect()->route('permohonan-surat.form')->with('success', 'Surat terbit berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan surat terbit: ' . $e->getMessage()]);
        }
    }

    public function index()
    {
        $data = PermohonanSurat::with(['templateSurat'])
            ->latest()
            ->get();
        return view('halaman.permohonan-surat.index', compact('data'));
    }

    public function edit($id)
    {
        $nomorSurat = SuratTerbitController::generateNomorSurat();
        $suratTerbit = SuratTerbit::with('isianSurat')->findOrFail($id);
        $template = TemplateSurat::with('isianTemplates')->findOrFail($suratTerbit->template_id);
        return view('halaman.permohonan-surat.edit', compact('suratTerbit', 'template', 'nomorSurat'));
    }

    public function update(Request $request, $id)
    {
        $suratTerbit = SuratTerbit::findOrFail($id);
        $validasi = $request->validate([
            'template_id' => 'required|exists:template_surat,id',
            'nomor_surat' => 'required|string|max:255',
            'judul_surat' => 'required|string|max:255',
            'nama_field.*' => 'required|string',
            'isi_field.*' => 'required|string',
        ], [
            'judul_surat.required' => 'Judul surat tidak boleh kosong.',
            'nama_field.*.required' => 'Nama field tidak boleh kosong.',
            'isi_field.*.required' => 'Isi field tidak boleh kosong.',
        ]);

        DB::beginTransaction();

        try {
            $suratTerbit->update([
                'template_id' => $validasi['template_id'],
                'nomor_surat' => $validasi['nomor_surat'],
                'judul_surat' => $validasi['judul_surat'],
                'terbit' => 1, // Set
            ]);

            $suratTerbit->permohonan()->update([
                'status' => 'disetujui',
            ]);

            // Hapus isian surat lama
            IsianSurat::where('surat_id', $id)->delete();

            // Tambah isian surat baru
            IsianSurat::create(['surat_id' => $suratTerbit->id, 'nama_field' => 'tahunsurat', 'isi_field' => date('Y')]);
            IsianSurat::create(['surat_id' => $suratTerbit->id, 'nama_field' => 'nomor', 'isi_field' => $validasi['nomor_surat']]);
            foreach ($validasi['nama_field'] as $index => $namaField) {
                IsianSurat::create([
                    'surat_id' => $suratTerbit->id,
                    'nama_field' => $namaField,
                    'isi_field' => $validasi['isi_field'][$index],
                ]);
            }
            DB::commit();
            return redirect()->route('surat-terbit.index')->with('success', 'Surat terbit berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui surat terbit: ' . $e->getMessage()]);
        }
    }

    public function tolakPermohonan($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->update(['status' => 'ditolak']);

        return redirect()->route('permohonan-surat.index')->with('success', 'Permohonan surat berhasil ditolak.');
    }
}
