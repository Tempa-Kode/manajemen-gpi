<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $table = 'jemaat';

    protected $fillable = [
        'id_kk',
        'nama_keluarga',
        'ayah',
        'ibu',
        'alamat',
        'no_hp',
        'tanggal_pendaftaran',
        'tgl_keluar',
        'tgl_meninggal_ayah',
        'tgl_meninggal_ibu',
    ];

    protected $casts = [
        'id_kk' => 'integer',
        'tanggal_pendaftaran' => 'date',
        'tgl_keluar' => 'date',
    ];

    // Relationship dengan SekolahMinggu
    public function sekolahMinggu()
    {
        return $this->hasMany(SekolahMinggu::class, 'id_kk');
    }

    // Relationship dengan Remaja
    public function remaja()
    {
        return $this->hasMany(Remaja::class, 'id_kk');
    }

    // Accessor untuk total anggota keluarga
    public function getTotalAnggotaAttribute()
    {
        return 2 + $this->sekolahMinggu()->count() + $this->remaja()->count();
    }
}
