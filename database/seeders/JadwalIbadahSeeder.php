<?php

namespace Database\Seeders;

use App\Models\JadwalIbadah;
use App\Models\JenisIbadah;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalIbadahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil jenis ibadah yang sudah ada
        $ibadahMingguRaya = JenisIbadah::where('jenis_ibadah', 'Ibadah Minggu Raya')->first();
        $ibadahPemuda = JenisIbadah::where('jenis_ibadah', 'Ibadah Pemuda/I')->first();
        $ibadahKaumIbu = JenisIbadah::where('jenis_ibadah', 'Ibadah Kaum Ibu')->first();
        $ibadahSekolahMinggu = JenisIbadah::where('jenis_ibadah', 'Ibadah Sekolah Minggu')->first();

        // Data jadwal ibadah untuk bulan ini
        $jadwalIbadah = [
            // Ibadah Minggu Raya - Minggu
            [
                'jenis_ibadah_id' => $ibadahMingguRaya?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->format('Y-m-d'),
                'jam' => '09:00',
                'tempat' => 'Gedung Gereja',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahMingguRaya?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->addWeek()->format('Y-m-d'),
                'jam' => '09:00',
                'tempat' => 'Gedung Gereja',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahMingguRaya?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->addWeeks(2)->format('Y-m-d'),
                'jam' => '09:00',
                'tempat' => 'Gedung Gereja',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahMingguRaya?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->addWeeks(3)->format('Y-m-d'),
                'jam' => '09:00',
                'tempat' => 'Gedung Gereja',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],

            // Ibadah Pemuda/I - Sabtu
            [
                'jenis_ibadah_id' => $ibadahPemuda?->id,
                'hari' => 'Sabtu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SATURDAY)->format('Y-m-d'),
                'jam' => '16:00',
                'tempat' => 'Ruang Pemuda',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahPemuda?->id,
                'hari' => 'Sabtu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SATURDAY)->addWeeks(2)->format('Y-m-d'),
                'jam' => '16:00',
                'tempat' => 'Ruang Pemuda',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],

            // Ibadah Kaum Ibu - Kamis
            [
                'jenis_ibadah_id' => $ibadahKaumIbu?->id,
                'hari' => 'Kamis',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::THURSDAY)->format('Y-m-d'),
                'jam' => '10:00',
                'tempat' => 'Ruang Kaum Ibu',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahKaumIbu?->id,
                'hari' => 'Kamis',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::THURSDAY)->addWeeks(2)->format('Y-m-d'),
                'jam' => '10:00',
                'tempat' => 'Ruang Kaum Ibu',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],

            // Ibadah Sekolah Minggu - Minggu
            [
                'jenis_ibadah_id' => $ibadahSekolahMinggu?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->format('Y-m-d'),
                'jam' => '11:00',
                'tempat' => 'Ruang Sekolah Minggu',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahSekolahMinggu?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->addWeek()->format('Y-m-d'),
                'jam' => '11:00',
                'tempat' => 'Ruang Sekolah Minggu',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahSekolahMinggu?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->addWeeks(2)->format('Y-m-d'),
                'jam' => '11:00',
                'tempat' => 'Ruang Sekolah Minggu',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
            [
                'jenis_ibadah_id' => $ibadahSekolahMinggu?->id,
                'hari' => 'Minggu',
                'tanggal' => Carbon::now()->startOfMonth()->next(Carbon::SUNDAY)->addWeeks(3)->format('Y-m-d'),
                'jam' => '11:00',
                'tempat' => 'Ruang Sekolah Minggu',
                'alamat' => 'Jl. Raya Perawang No. 123, Perawang, Siak',
            ],
        ];

        foreach ($jadwalIbadah as $jadwal) {
            if ($jadwal['jenis_ibadah_id']) {
                JadwalIbadah::create($jadwal);
            }
        }

        echo "Seeder berhasil! Total jadwal ibadah yang dibuat: " . JadwalIbadah::count() . PHP_EOL;
    }
}
