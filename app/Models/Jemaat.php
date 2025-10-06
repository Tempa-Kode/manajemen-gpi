<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    protected $table = 'jemaat';

    protected $fillable = [
        'id_kk',
        'nama_keluarga',
        'ayah',
        'tempat_lahir_ayah',
        'tgl_lahir_ayah',
        'ibu',
        'tempat_lahir_ibu',
        'tgl_lahir_ibu',
        'alamat',
        'no_hp',
        'tanggal_pendaftaran',
        'tgl_keluar',
        'tgl_meninggal_ayah',
        'tgl_meninggal_ibu',
    ];

    protected $casts = [
        'id_kk' => 'integer',
        'tanggal_pendaftaran' => 'date',
        'tgl_keluar' => 'date',
        'tgl_meninggal_ayah' => 'date',
        'tgl_meninggal_ibu' => 'date',
        'tgl_lahir_ayah' => 'date',
        'tgl_lahir_ibu' => 'date',
    ];

    // Relationship dengan SekolahMinggu
    public function sekolahMinggu()
    {
        return $this->hasMany(SekolahMinggu::class, 'id_kk');
    }

    // Relationship dengan Remaja
    public function remaja()
    {
        return $this->hasMany(Remaja::class, 'id_kk');
    }

    // Accessor untuk total anggota keluarga
    public function getTotalAnggotaAttribute()
    {
        return 2 + $this->sekolahMinggu()->count() + $this->remaja()->count();
    }

    // Accessor untuk status ayah
    public function getStatusAyahAttribute()
    {
        if ($this->tgl_meninggal_ayah) {
            return 'Meninggal';
        }
        return 'Aktif';
    }

    // Accessor untuk status ibu
    public function getStatusIbuAttribute()
    {
        if ($this->tgl_meninggal_ibu) {
            return 'Meninggal';
        }
        return 'Aktif';
    }

    // Accessor untuk status keluarga keseluruhan
    public function getStatusKeluargaAttribute()
    {
        if ($this->tgl_keluar) {
            return 'Keluar';
        }
        if ($this->tgl_meninggal_ayah && $this->tgl_meninggal_ibu) {
            return 'Kedua Orang Tua Meninggal';
        }
        if ($this->tgl_meninggal_ayah || $this->tgl_meninggal_ibu) {
            return 'Salah Satu Orang Tua Meninggal';
        }
        return 'Aktif';
    }

    // Scope untuk keluarga aktif
    public function scopeAktif($query)
    {
        return $query->whereNull('tgl_keluar');
    }

    // Scope untuk keluarga yang keluar
    public function scopeKeluar($query)
    {
        return $query->whereNotNull('tgl_keluar');
    }

    // Scope untuk keluarga dengan ayah meninggal
    public function scopeAyahMeninggal($query)
    {
        return $query->whereNotNull('tgl_meninggal_ayah');
    }

    // Scope untuk keluarga dengan ibu meninggal
    public function scopeIbuMeninggal($query)
    {
        return $query->whereNotNull('tgl_meninggal_ibu');
    }
}
