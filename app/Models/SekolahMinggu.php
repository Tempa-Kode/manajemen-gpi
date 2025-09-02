<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SekolahMinggu extends Model
{
    protected $table = 'sekolah_minggu';

    protected $fillable = [
        'id_kk',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'kelas',
        'tgl_meninggal',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tgl_meninggal' => 'date',
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
        if ($this->tgl_meninggal) {
            return 'Meninggal';
        }
        return $this->status == 'aktif' ? 'Aktif' : 'Tidak Aktif';
    }

    // Accessor untuk status keaktifan berdasarkan kematian
    public function getStatusKeaktifanAttribute()
    {
        if ($this->tgl_meninggal) {
            return 'Meninggal';
        }
        return 'Hidup';
    }

    // Scope untuk filter aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif')->whereNull('tgl_meninggal');
    }

    // Scope untuk filter meninggal
    public function scopeMeninggal($query)
    {
        return $query->whereNotNull('tgl_meninggal');
    }

    // Scope untuk filter hidup
    public function scopeHidup($query)
    {
        return $query->whereNull('tgl_meninggal');
    }
}
