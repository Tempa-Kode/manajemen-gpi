<?php

namespace Database\Seeders;

use App\Models\TemplateSurat;
use App\Models\IsianTemplate;
use Illuminate\Database\Seeder;

class SuratKeteranganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah template sudah ada
        $existingTemplate = TemplateSurat::where('nama_template', 'Surat Keterangan Anggota Jemaat')->first();

        if (!$existingTemplate) {
            // Buat template surat
            $template = TemplateSurat::create([
                'nama_template' => 'Surat Keterangan Anggota Jemaat',
                'deskripsi' => 'Template surat keterangan untuk anggota jemaat GPI Sidang Perawang',
                'path_file' => 'templatesurat/surat-keterangan-template.docx', // File template akan dibuat terpisah
            ]);

            // Buat field-field yang diperlukan
            $fields = [
                ['nama_field' => 'nomor', 'label' => 'Nomor Surat', 'tipe' => 'text'],
                ['nama_field' => 'nama', 'label' => 'Nama Lengkap', 'tipe' => 'text'],
                ['nama_field' => 'ttl', 'label' => 'Tempat/Tanggal Lahir', 'tipe' => 'text'],
                ['nama_field' => 'jenis-kelamin', 'label' => 'Jenis Kelamin', 'tipe' => 'select'],
                ['nama_field' => 'nama-keluarga', 'label' => 'Nama Keluarga', 'tipe' => 'text'],
                ['nama_field' => 'anggota-jemaat', 'label' => 'Anggota Jemaat', 'tipe' => 'text'],
                ['nama_field' => 'sidang', 'label' => 'Sidang', 'tipe' => 'text'],
            ];

            foreach ($fields as $field) {
                IsianTemplate::create([
                    'template_id' => $template->id,
                    'nama_field' => $field['nama_field'],
                    'label' => $field['label'],
                    'tipe' => $field['tipe'],
                ]);
            }

            $this->command->info('Template Surat Keterangan Anggota Jemaat berhasil dibuat.');
        } else {
            $this->command->info('Template Surat Keterangan Anggota Jemaat sudah ada.');
        }
    }
}
