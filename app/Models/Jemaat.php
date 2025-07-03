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
}
