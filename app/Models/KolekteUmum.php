<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KolekteUmum extends Model
{
    protected $table = 'kolekte_umum';

    protected $fillable = [
        'jadwal_ibadah_id',
        'nominal',
    ];

    public function jadwalIbadah()
    {
        return $this->belongsTo(JadwalIbadah::class, 'jadwal_ibadah_id');
    }
}
