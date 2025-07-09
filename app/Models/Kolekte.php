<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kolekte extends Model
{
    protected $fillable = [
        'tanggal',
        'jenis_ibadah',
        'kolekte_umum',
        'kolekte_pembangunan',
        'kolekte_diakonia',
        'nama_kolekte_lain',
        'jumlah_kolekte_lain',
        'total_kolekte',
        'keterangan',
        'pencatat',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'kolekte_umum' => 'decimal:2',
        'kolekte_pembangunan' => 'decimal:2',
        'kolekte_diakonia' => 'decimal:2',
        'jumlah_kolekte_lain' => 'decimal:2',
        'total_kolekte' => 'decimal:2',
    ];

    // Accessor untuk format tanggal Indonesia
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal->format('d F Y');
    }

    // Accessor untuk total kolekte rutin
    public function getTotalKolekteRutinAttribute()
    {
        return $this->kolekte_umum + $this->kolekte_pembangunan + $this->kolekte_diakonia;
    }

    // Mutator untuk menghitung total kolekte otomatis
    public function setTotalKolekteAttribute($value)
    {
        $total_rutin = ($this->kolekte_umum ?? 0) + ($this->kolekte_pembangunan ?? 0) + ($this->kolekte_diakonia ?? 0);
        $total_lain = $this->jumlah_kolekte_lain ?? 0;
        $this->attributes['total_kolekte'] = $total_rutin + $total_lain;
    }

    // Boot method untuk auto-calculate total
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $total_rutin = ($model->kolekte_umum ?? 0) + ($model->kolekte_pembangunan ?? 0) + ($model->kolekte_diakonia ?? 0);
            $total_lain = $model->jumlah_kolekte_lain ?? 0;
            $model->total_kolekte = $total_rutin + $total_lain;
        });
    }

    // Scope untuk filter berdasarkan bulan
    public function scopeByMonth($query, $month, $year)
    {
        return $query->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
    }

    // Scope untuk filter berdasarkan tahun
    public function scopeByYear($query, $year)
    {
        return $query->whereYear('tanggal', $year);
    }
}
