<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Remaja extends Model
{
    protected $table = 'remaja';

    protected $fillable = [
        'id_kk',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'pendidikan',
        'pekerjaan',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relationship dengan Jemaat
    public function jemaat()
    {
        return $this->belongsTo(Jemaat::class, 'id_kk');
    }

    // Accessor untuk umur
    public function getUmurAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    // Accessor untuk jenis kelamin
    public function getJenisKelaminTextAttribute()
    {
        return $this->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    }

    // Accessor untuk status
    public function getStatusTextAttribute()
    {
        return $this->status == 'aktif' ? 'Aktif' : 'Tidak Aktif';
    }

    // Scope untuk filter aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
