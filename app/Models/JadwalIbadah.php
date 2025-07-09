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
        'tempat',
        'alamat',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Accessor untuk format jam
    public function getJamAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('H:i') : $value;
    }

    public function pendaftarIbadah()
    {
        return $this->hasMany(PendaftaranIbadah::class, 'jadwal_ibadah_id');
    }
}
