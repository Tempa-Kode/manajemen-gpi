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
            ['jenis_ibadah' => 'Kebaktian Umum'],
            ['jenis_ibadah' => 'Doa Syafaat'],
            ['jenis_ibadah' => 'Ibadah Anak'],
            ['jenis_ibadah' => 'Ibadah Remaja'],
            ['jenis_ibadah' => 'Ibadah Lansia'],
            ['jenis_ibadah' => 'Perayaan Paskah'],
            ['jenis_ibadah' => 'Perayaan Natal'],
            ['jenis_ibadah' => 'Ibadah Rumah'],
            ['jenis_ibadah' => 'Ibadah Pernikahan'],
            ['jenis_ibadah' => 'Ibadah Pemakaman'],
        ];

        foreach ($jenisIbadah as $jenis) {
            JenisIbadah::create($jenis);
        }
    }
}
