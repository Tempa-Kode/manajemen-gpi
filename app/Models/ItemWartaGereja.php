<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemWartaGereja extends Model
{
    protected $table = 'item_warta_gereja';
    protected $fillable = [
        'warta_gereja_id',
        'nama_item_warta_gereja',
        'deskripsi_item_warta',
    ];
}
