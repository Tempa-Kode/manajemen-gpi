<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalIbadah extends Model
{
    protected $table = 'jadwal_ibadah';
    protected $fillable = [
        'jenis_ibadah',
        'hari',
        'tanggal',
        'jam',
    ];

    public function pendaftarIbadah()
    {
        return $this->hasMany(PendaftaranIbadah::class, 'jadwal_ibadah_id');
    }
}
