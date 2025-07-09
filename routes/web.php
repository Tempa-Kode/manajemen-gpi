<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-gereja', [HomeController::class, 'tentangGereja'])->name('tentangGereja');
Route::get('/struktur-gereja', [HomeController::class, 'strukturGereja'])->name('strukturGereja');
Route::get('/jadwal-pelayanan', [HomeController::class, 'jadwalPelayanan'])->name('jadwalPelayanan');
Route::get('/pendaftaran-ibadah', [HomeController::class, 'pendaftaranIbadah'])->name('pendaftaranIbadah');
Route::post('/pendaftaran-ibadah', [HomeController::class, 'storePendaftaranIbadah'])->name('pendaftaranIbadah.store');
Route::delete('/pendaftaran-ibadah/{id}', [HomeController::class, 'cancelPendaftaranIbadah'])->name('pendaftaranIbadah.cancel');

Route::get('login', [AutentikasiController::class, 'login'])->name('login');
Route::post('login', [AutentikasiController::class, 'prosesLogin'])->name('prosesLogin');
Route::post('logout', [AutentikasiController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::get('daftar-tamu', [App\Http\Controllers\TamuController::class, 'daftarTamu'])->name('daftarTamu');
Route::post('daftar-tamu', [App\Http\Controllers\TamuController::class, 'prosesDaftarTamu'])->name('daftarTamu.store');

Route::get('dashboard', [AutentikasiController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('dashboard');

Route::resource('admin', App\Http\Controllers\AdminController::class)
    ->middleware(['auth', 'admin'])
    ->names('admin');

Route::resource('tamu', App\Http\Controllers\TamuController::class)
    ->middleware(['auth', 'admin'])
    ->names('tamu');

Route::resource('jemaat', App\Http\Controllers\JemaatController::class)
    ->middleware(['auth', 'admin'])
    ->names('jemaat');

Route::resource('jadwal-ibadah', App\Http\Controllers\JadwalIbadahController::class)
    ->middleware(['auth', 'admin'])
    ->names('jadwal-ibadah');

Route::resource('jenis-ibadah', App\Http\Controllers\JenisIbadahController::class)
    ->middleware(['auth', 'admin'])
    ->names('jenis-ibadah');

Route::resource('warta-gereja', App\Http\Controllers\WartaGerejaController::class)
    ->middleware(['auth', 'admin'])
    ->names('warta-gereja');

Route::resource('data-jemaat', App\Http\Controllers\DataJemaatController::class)
    ->middleware(['auth', 'admin'])
    ->names('data-jemaat');

Route::resource('sekolah-minggu', App\Http\Controllers\SekolahMingguController::class)
    ->middleware(['auth', 'admin'])
    ->names('sekolah-minggu');

Route::resource('remaja', App\Http\Controllers\RemajaController::class)
    ->middleware(['auth', 'admin'])
    ->names('remaja');

// Route untuk print data jemaat
Route::get('data-jemaat/{id}/print', [App\Http\Controllers\DataJemaatController::class, 'print'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.print');
