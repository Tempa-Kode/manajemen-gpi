<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WartaGereja extends Model
{
    protected $table = 'warta_gereja';
    protected $fillable = [
        'nama_warta',
        'tanggal',
    ];
}
