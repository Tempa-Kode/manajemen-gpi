<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remaja extends Model
{
    protected $table = 'remaja';

    protected $fillable = [
        'jemaat_id',
        'nama_anak',
    ];
}
