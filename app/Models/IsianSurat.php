<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsianSurat extends Model
{
    protected $table = 'isian_surat';

    protected $fillable = [
        'surat_id',
        'nama_field',
        'isi_field',
    ];

    public function surat()
    {
        return $this->belongsTo(SuratTerbit::class, 'surat_id');
    }
}
