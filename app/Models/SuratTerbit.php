<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTerbit extends Model
{
    protected $table = 'surat_terbit';

    protected $fillable = [
        'permohonan_id',
        'template_id',
        'nomor_surat',
        'judul_surat',
        'terbit',
    ];

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function isianSurat()
    {
        return $this->hasMany(IsianSurat::class, 'surat_id');
    }

    public function permohonan()
    {
        return $this->belongsTo(PermohonanSurat::class, 'permohonan_id');
    }
}
