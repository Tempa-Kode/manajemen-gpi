<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UcapanSyukur extends Model
{
    protected $table = 'ucapan_syukur';

    protected $fillable = [
        'nama',
        'nominal',
        'bukti_transfer',
        'no_hp',
        'status',
    ];

    public function getFormattedNominalAttribute()
    {
        return number_format($this->nominal, 2, ',', '.');
    }

    public function getFormattedBuktiTransferAttribute()
    {
        return asset('storage/' . $this->bukti_transfer);
    }
}
