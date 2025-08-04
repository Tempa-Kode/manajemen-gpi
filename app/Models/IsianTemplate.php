<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IsianTemplate extends Model
{
    protected $table = 'isian_template';

    protected $fillable = [
        'template_id',
        'nama_field',
        'label',
        'tipe',
    ];

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class, 'template_id');
    }
}
