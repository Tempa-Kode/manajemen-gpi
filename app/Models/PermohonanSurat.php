<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    protected $table = 'permohonan_surat';

    protected $fillable = [
        'template_surat_id',
        'nama_pemohon',
        'no_telp',
        'status',
        'user_id',
    ];

    public function templateSurat()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_surat_id');
    }

    public function suratTerbit()
    {
        return $this->hasOne(SuratTerbit::class, 'permohonan_id');
    }
}
