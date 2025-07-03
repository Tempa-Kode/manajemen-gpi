<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranIbadah extends Model
{
    protected $table = 'pendaftaran_ibadah';
    protected $fillable = [
        'user_id',
        'jadwal_ibadah_id',
        'keterlibatan',
    ];
}
