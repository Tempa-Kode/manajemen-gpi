<?php

namespace App\Http\Controllers;

use App\Models\IsianSurat;
use App\Models\IsianTemplate;
use App\Models\SuratTerbit;
use App\Models\TemplateSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratTerbitController extends Controller
{
    public function index()
    {
        $data = SuratTerbit::where('terbit', true)->latest()->get();
        $templates = TemplateSurat::all();
        return view('halaman.surat-terbit.index', compact('data', 'templates'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:template_surat,id',
        ]);

        $nomorSurat = $this->generateNomorSurat();
        $tahun = date('Y');
        $template = TemplateSurat::where('id', $request->template_id)->with('isianTemplates')->first();

        return view('halaman.surat-terbit.tambah', compact('template', 'nomorSurat', 'tahun'));
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
            IsianSurat::create([
                'surat_id' => $suratTerbit->id,
                'nama_field' => 'nomor',
                'isi_field' => $validasi['nomor_surat'],
            ]);
            IsianSurat::create([
                'surat_id' => $suratTerbit->id,
                'nama_field' => 'tahunsurat',
                'isi_field' => date('Y'),
            ]);
            foreach ($validasi['nama_field'] as $index => $namaField) {
                IsianSurat::create([
                    'surat_id' => $suratTerbit->id,
                    'nama_field' => $namaField,
                    'isi_field' => $validasi['isi_field'][$index],
                ]);
            }
            DB::commit();
            return redirect()->route('surat-terbit.index')->with('success', 'Permohonan surat berhasil disimpan. Silakan tunggu proses verifikasi dari admin.');
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

            IsianSurat::create([
                'surat_id' => $suratTerbit->id,
                'nama_field' => 'nomor',
                'isi_field' => $validasi['nomor_surat'],
            ]);
            IsianSurat::create([
                'surat_id' => $suratTerbit->id,
                'nama_field' => 'tahunsurat',
                'isi_field' => date('Y'),
            ]);
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
        try {
            $suratTerbit = SuratTerbit::with('isianSurat', 'template')->findOrFail($id);

            // Pastikan template file ada
            $templatePath = storage_path('app/private/' . $suratTerbit->template->path_file);
            if (!file_exists($templatePath)) {
                return redirect()->back()->withErrors(['error' => 'Template file tidak ditemukan.']);
            }

            // Validasi template file bisa dibaca
            if (!is_readable($templatePath)) {
                return redirect()->back()->withErrors(['error' => 'Template file tidak dapat dibaca. Periksa permission file.']);
            }

            // Cek ukuran file template
            $fileSize = filesize($templatePath);
            if ($fileSize === false || $fileSize === 0) {
                return redirect()->back()->withErrors(['error' => 'Template file kosong atau corrupt.']);
            }

            // Log untuk debugging
            Log::info("Processing template: " . $templatePath . " (Size: " . $fileSize . " bytes)");

            $templateProcessor = new TemplateProcessor($templatePath);

            // Set nilai untuk setiap field dengan validasi yang lebih ketat
            foreach ($suratTerbit->isianSurat as $isian) {
                if (empty(trim($isian->nama_field))) {
                    continue; // Skip field kosong
                }

                // Bersihkan nilai dari karakter yang bisa merusak format
                $cleanValue = $isian->isi_field ?? '';
                $cleanValue = strip_tags($cleanValue);
                $cleanValue = str_replace(["\r\n", "\r", "\n"], ' ', $cleanValue);

                // Hapus karakter khusus yang bisa merusak XML
                $cleanValue = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $cleanValue);

                // Batasi panjang nilai (opsional)
                $cleanValue = mb_substr($cleanValue, 0, 1000);

                // Log field yang diproses
                Log::info("Setting field: {$isian->nama_field} = {$cleanValue}");

                try {
                    $templateProcessor->setValue($isian->nama_field, $cleanValue);
                } catch (\Exception $fieldError) {
                    Log::error("Error setting field {$isian->nama_field}: " . $fieldError->getMessage());
                    // Lanjutkan dengan field lainnya
                }
            }

            // Buat nama file yang aman
            $fileName = 'surat_' . $suratTerbit->id . '_' . date('Y-m-d_H-i-s') . '.docx';
            $tempPath = storage_path('app/temp/' . $fileName);

            // Pastikan direktori temp ada
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            // Simpan file dengan error handling
            try {
                $templateProcessor->saveAs($tempPath);
                Log::info("File saved successfully: " . $tempPath);
            } catch (\Exception $saveError) {
                Log::error("Error saving file: " . $saveError->getMessage());
                return redirect()->back()->withErrors(['error' => 'Gagal menyimpan file: ' . $saveError->getMessage()]);
            }

            // Pastikan file berhasil dibuat dan memiliki ukuran yang wajar
            if (!file_exists($tempPath)) {
                return redirect()->back()->withErrors(['error' => 'Gagal membuat file surat.']);
            }

            $outputFileSize = filesize($tempPath);
            if ($outputFileSize === false || $outputFileSize < 1000) {
                Log::error("Output file too small: " . $outputFileSize . " bytes");
                return redirect()->back()->withErrors(['error' => 'File yang dihasilkan tidak valid.']);
            }

            return response()->download($tempPath, $fileName)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error("Download error for surat ID {$id}: " . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public static function generateNomorSurat()
    {
        // Ambil semua surat yang memiliki nomor_surat, urutkan dari yang terbaru
        $suratDenganNomor = SuratTerbit::whereNotNull('nomor_surat')
            ->where('nomor_surat', '!=', '')
            ->latest()
            ->get();

        // Jika tidak ada surat dengan nomor sama sekali
        if ($suratDenganNomor->isEmpty()) {
            return 1;
        }

        // Loop untuk mencari nomor surat yang valid
        foreach ($suratDenganNomor as $surat) {
            if (!empty($surat->nomor_surat)) {
                // Ekstrak nomor dari format: 7532/62sd/GPI/2025
                $nomorParts = explode('/', $surat->nomor_surat);

                if (!empty($nomorParts[0]) && is_numeric($nomorParts[0])) {
                    return (int)$nomorParts[0] + 1;
                }
            }
        }

        // Jika semua surat tidak memiliki format nomor yang valid
        return 1;
    }

    public function destroy($id)
    {
        $suratTerbit = SuratTerbit::findOrFail($id);
        DB::beginTransaction();

        try {
            $suratTerbit->isianSurat()->delete();
            $suratTerbit->delete();
            DB::commit();
            return redirect()->route('surat-terbit.index')->with('success', 'Surat terbit berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus surat terbit: ' . $e->getMessage()]);
        }
    }
}
