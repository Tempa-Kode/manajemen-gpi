<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratTerbit extends Model
{
    protected $table = 'surat_terbit';

    protected $fillable = [
        'template_id',
        'judul_surat',
        'path_output',
    ];

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
