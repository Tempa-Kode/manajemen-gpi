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
    ];

    public function templateSurat()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_surat_id');
    }

}
