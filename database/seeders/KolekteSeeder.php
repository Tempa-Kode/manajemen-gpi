<?php

namespace Database\Seeders;

use App\Models\Kolekte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KolekteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kolektes = [
            [
                'jadwal_ibadah_id' => null,
                'tanggal_ibadah' => '2025-01-05',
                'pembangunan_gereja' => 500000,
                'persembahan_pelayanan_pengerja' => 300000,
                'persembahan_pelayanan_sosial_gereja' => 200000,
                'keterangan' => 'Kolekte minggu pertama Januari 2025',
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'jadwal_ibadah_id' => null,
                'tanggal_ibadah' => '2025-01-12',
                'pembangunan_gereja' => 750000,
                'persembahan_pelayanan_pengerja' => 450000,
                'persembahan_pelayanan_sosial_gereja' => 300000,
                'keterangan' => 'Kolekte minggu kedua Januari 2025',
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],
            [
                'jadwal_ibadah_id' => null,
                'tanggal_ibadah' => '2025-01-19',
                'pembangunan_gereja' => 600000,
                'persembahan_pelayanan_pengerja' => 400000,
                'persembahan_pelayanan_sosial_gereja' => 250000,
                'keterangan' => 'Kolekte minggu ketiga Januari 2025',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],
            [
                'jadwal_ibadah_id' => null,
                'tanggal_ibadah' => '2025-01-26',
                'pembangunan_gereja' => 800000,
                'persembahan_pelayanan_pengerja' => 500000,
                'persembahan_pelayanan_sosial_gereja' => 350000,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($kolektes as $kolekte) {
            Kolekte::create($kolekte);
        }
    }
}
