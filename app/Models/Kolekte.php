<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kolekte extends Model
{
    protected $table = 'kolekte';

    protected $fillable = [
        'jadwal_ibadah_id',
        'tanggal_ibadah',
        'pembangunan_gereja',
        'persembahan_pelayanan_pengerja',
        'persembahan_pelayanan_sosial_gereja',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_ibadah' => 'date',
        'pembangunan_gereja' => 'decimal:2',
        'persembahan_pelayanan_pengerja' => 'decimal:2',
        'persembahan_pelayanan_sosial_gereja' => 'decimal:2',
    ];

    public function jadwalIbadah()
    {
        return $this->belongsTo(JadwalIbadah::class);
    }
}
