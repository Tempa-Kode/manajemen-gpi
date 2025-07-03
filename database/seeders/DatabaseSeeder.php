<?php

namespace Database\Seeders;

use App\Models\HakAkses;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $hak_akses = [
            'Admin',
            'Jemaat',
            'Tamu',
        ];

        HakAkses::insert(
            array_map(fn($akses) => ['akses' => $akses], $hak_akses)
        );

        $adminAkses = HakAkses::where('akses', 'Admin')->first();
        $jemaatAkses = HakAkses::where('akses', 'Jemaat')->first();
        $tamuAkses = HakAkses::where('akses', 'Tamu')->first();

        User::create([
            'name' => 'Admin Gereja',
            'username' => 'admin',
            'email' => 'admin@gpi.org',
            'password' => bcrypt('admin123'),
            'no_telp' => '081234567890',
            'hak_akses_id' => $adminAkses->id,
        ]);

        User::create([
            'name' => 'Jemaat Test',
            'username' => 'jemaattest',
            'email' => 'jemaat@gpi.org',
            'password' => bcrypt('jemaat123'),
            'no_telp' => '081234567890',
            'hak_akses_id' => $jemaatAkses->id,
        ]);

        User::create([
            'name' => 'Tamu Test',
            'username' => 'tamutest',
            'email' => 'tamu@gpi.org',
            'password' => bcrypt('tamu123'),
            'no_telp' => '081234567890',
            'hak_akses_id' => $tamuAkses->id,
        ]);
    }
}
