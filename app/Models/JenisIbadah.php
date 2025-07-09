<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisIbadah extends Model
{
    protected $table = 'jenis_ibadah';

    protected $fillable = [
        'jenis_ibadah'
    ];

    /**
     * Relasi ke JadwalIbadah (One to Many)
     * Satu jenis ibadah memiliki banyak jadwal ibadah
     */
    public function jadwalIbadah()
    {
        return $this->hasMany(JadwalIbadah::class, 'jenis_ibadah_id');
    }
}
