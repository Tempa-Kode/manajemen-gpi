<?php

namespace App\Http\Controllers;

use App\Models\IsianSurat;
use App\Models\IsianTemplate;
use App\Models\SuratTerbit;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratTerbitController extends Controller
{
    public function index()
    {
        $data = SuratTerbit::all();
        $templates = TemplateSurat::all();
        return view('halaman.surat-terbit.index', compact('data', 'templates'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:template_surat,id',
        ]);

        $template = TemplateSurat::where('id', $request->template_id)->with('isianTemplates')->first();

        return view('halaman.surat-terbit.tambah', compact('template'));
    }

    public function store(Request $request)
    {
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
            $suratTerbit = SuratTerbit::create([
                'template_id' => $validasi['template_id'],
                'nomor_surat' => $validasi['nomor_surat'],
                'judul_surat' => $validasi['judul_surat'],
            ]);

            foreach ($validasi['nama_field'] as $index => $namaField) {
                IsianSurat::create([
                    'surat_id' => $suratTerbit->id,
                    'nama_field' => $namaField,
                    'isi_field' => $validasi['isi_field'][$index],
                ]);
            }
            DB::commit();
            return redirect()->route('permohonan-surat.form')->with('success', 'Permohonan surat berhasil disimpan. Silakan tunggu proses verifikasi dari admin.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan surat terbit: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $suratTerbit = SuratTerbit::with('isianSurat')->findOrFail($id);
        $template = TemplateSurat::with('isianTemplates')->findOrFail($suratTerbit->template_id);
        return view('halaman.surat-terbit.edit', compact('suratTerbit', 'template'));
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
            ]);

            // Hapus isian surat lama
            IsianSurat::where('surat_id', $id)->delete();

            // Tambah isian surat baru
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

    public function downloadSurat($id)
    {
        $suratTerbit = SuratTerbit::with('isianSurat', 'template')->findOrFail($id);
        $templateProcessor = new TemplateProcessor(storage_path('app/private/' . $suratTerbit->template->path_file));

        foreach ($suratTerbit->isianSurat as $isian) {
            $templateProcessor->setValue($isian->nama_field, $isian->isi_field);
        }

        $tmpFile = tempnam(sys_get_temp_dir(), 'surat_') . '.docx';
        $templateProcessor->saveAs($tmpFile);

        return response()->download($tmpFile, 'surat_' . $suratTerbit->id . '.docx')->deleteFileAfterSend(true);
    }
}
