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
    ];

    protected $casts = [
        'id_kk' => 'integer',
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
