<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SekolahMinggu extends Model
{
    protected $table = 'sekolah_minggu';

    protected $fillable = [
        'jemaat_id',
        'nama_anak',
    ];
}
