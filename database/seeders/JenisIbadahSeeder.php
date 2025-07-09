<?php

namespace Database\Seeders;

use App\Models\JenisIbadah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisIbadahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisIbadah = [
            ['jenis_ibadah' => 'Ibadah Minggu Raya'],
            ['jenis_ibadah' => 'Ibadah Mingguan'],
            ['jenis_ibadah' => 'Ibadah Pemuda/I'],
            ['jenis_ibadah' => 'Ibadah Kaum Ibu'],
            ['jenis_ibadah' => 'Ibadah Sekolah Minggu'],
            ['jenis_ibadah' => 'Ibadah Selasa Malam'],
        ];

        foreach ($jenisIbadah as $jenis) {
            JenisIbadah::create($jenis);
        }
    }
}
