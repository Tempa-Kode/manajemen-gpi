<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranIbadah extends Model
{
    protected $table = 'pendaftaran_ibadah';
    protected $fillable = [
        'user_id',
        'jadwal_ibadah_id',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalIbadah()
    {
        return $this->belongsTo(JadwalIbadah::class, 'jadwal_ibadah_id');
    }
}
