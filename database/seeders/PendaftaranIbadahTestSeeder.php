<?php

namespace Database\Seeders;

use App\Models\JadwalIbadah;
use App\Models\JenisIbadah;
use App\Models\PendaftaranIbadah;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendaftaranIbadahTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user jemaat untuk testing
        $user = User::where('email', 'jemaat@gpi.org')->first();

        if (!$user) {
            $this->command->info('User jemaat@gpi.org tidak ditemukan. Jalankan DatabaseSeeder terlebih dahulu.');
            return;
        }

        // Buat jadwal ibadah untuk testing dengan berbagai waktu
        $jenisIbadah = JenisIbadah::first();

        if (!$jenisIbadah) {
            $this->command->info('Jenis ibadah tidak ditemukan. Jalankan JenisIbadahSeeder terlebih dahulu.');
            return;
        }

        // 1. Jadwal ibadah hari ini (tidak bisa dibatalkan)
        $jadwalHariIni = JadwalIbadah::create([
            'jenis_ibadah_id' => $jenisIbadah->id,
            'hari' => Carbon::now()->translatedFormat('l'),
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'jam' => '19:00:00',
        ]);

        // 2. Jadwal ibadah besok (tidak bisa dibatalkan karena kurang dari 24 jam)
        $jadwalBesok = JadwalIbadah::create([
            'jenis_ibadah_id' => $jenisIbadah->id,
            'hari' => Carbon::now()->addDay()->translatedFormat('l'),
            'tanggal' => Carbon::now()->addDay()->format('Y-m-d'),
            'jam' => '10:00:00',
        ]);

        // 3. Jadwal ibadah lusa (masih bisa dibatalkan)
        $jadwalLusa = JadwalIbadah::create([
            'jenis_ibadah_id' => $jenisIbadah->id,
            'hari' => Carbon::now()->addDays(2)->translatedFormat('l'),
            'tanggal' => Carbon::now()->addDays(2)->format('Y-m-d'),
            'jam' => '19:00:00',
        ]);

        // 4. Jadwal ibadah minggu depan (masih bisa dibatalkan)
        $jadwalMingguDepan = JadwalIbadah::create([
            'jenis_ibadah_id' => $jenisIbadah->id,
            'hari' => Carbon::now()->addWeek()->translatedFormat('l'),
            'tanggal' => Carbon::now()->addWeek()->format('Y-m-d'),
            'jam' => '10:00:00',
        ]);

        // Buat pendaftaran untuk testing
        $pendaftaranData = [
            [
                'jadwal_ibadah_id' => $jadwalHariIni->id,
                'keterangan' => 'Pendaftaran hari ini - tidak bisa dibatalkan',
            ],
            [
                'jadwal_ibadah_id' => $jadwalBesok->id,
                'keterangan' => 'Pendaftaran besok - kemungkinan tidak bisa dibatalkan',
            ],
            [
                'jadwal_ibadah_id' => $jadwalLusa->id,
                'keterangan' => 'Pendaftaran lusa - masih bisa dibatalkan',
            ],
            [
                'jadwal_ibadah_id' => $jadwalMingguDepan->id,
                'keterangan' => 'Pendaftaran minggu depan - masih bisa dibatalkan',
            ],
        ];

        foreach ($pendaftaranData as $data) {
            PendaftaranIbadah::create([
                'user_id' => $user->id,
                'jadwal_ibadah_id' => $data['jadwal_ibadah_id'],
                'keterangan' => $data['keterangan'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $this->command->info('Seeder PendaftaranIbadahTestSeeder berhasil dijalankan.');
        $this->command->info('Data testing untuk logic H-1 pembatalan pendaftaran telah dibuat.');
    }
}
