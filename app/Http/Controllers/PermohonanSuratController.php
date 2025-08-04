<?php

namespace App\Http\Controllers;

use App\Models\IsianSurat;
use App\Models\PermohonanSurat;
use App\Models\SuratTerbit;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return redirect()->route('surat-terbit.index')->with('success', 'Surat terbit berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan surat terbit: ' . $e->getMessage()]);
        }
    }
}
