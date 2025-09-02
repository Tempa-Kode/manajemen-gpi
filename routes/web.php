<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JemaatController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-gereja', [HomeController::class, 'tentangGereja'])->name('tentangGereja');
Route::get('/struktur-gereja', [HomeController::class, 'strukturGereja'])->name('strukturGereja');
Route::get('/jadwal-pelayanan', [HomeController::class, 'jadwalPelayanan'])->name('jadwalPelayanan');
Route::get('/pendaftaran-ibadah', [\App\Http\Controllers\PendaftaranIbadahController::class, 'halamanPendaftaranIbadah'])->name('pendaftaranIbadah');
Route::post('/pendaftaran-ibadah', [\App\Http\Controllers\PendaftaranIbadahController::class, 'storePendaftaranIbadah'])->name('pendaftaranIbadah.store');
Route::delete('/pendaftaran-ibadah/{id}', [HomeController::class, 'cancelPendaftaranIbadah'])->name('pendaftaranIbadah.cancel');
Route::get('/wartagereja', [HomeController::class, 'wartaGereja'])->name('wartaGerejaLanding');
Route::get('/wartagereja/{id}', [HomeController::class, 'detailWartaGereja'])->name('detailWartaGereja');
Route::get('/profil', [HomeController::class, 'profilJemaat'])->middleware(['auth'])->name('profil');

Route::put('/profil/update', [JemaatController::class, 'updateProfile'])->name('profil.update');
Route::put('/profil/password', [JemaatController::class, 'updatePassword'])->name('profil.password');

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

// Route untuk download PDF pendaftar per jadwal ibadah
Route::get('jadwal-ibadah/{id}/download-pendaftar', [App\Http\Controllers\JadwalIbadahController::class, 'downloadPendaftarPDF'])
    ->middleware(['auth', 'admin'])
    ->name('jadwal-ibadah.download-pendaftar');
Route::put('pendaftaran/{id}/konfirmasi', [\App\Http\Controllers\PendaftaranIbadahController::class, 'konfirmasi'])
    ->middleware(['auth', 'admin'])
    ->name('pendaftaran.konfirmasi');
Route::put('pendaftaran/{id}/tolak', [\App\Http\Controllers\PendaftaranIbadahController::class, 'tolak'])
    ->middleware(['auth', 'admin'])
    ->name('pendaftaran.tolak');

Route::resource('jenis-ibadah', App\Http\Controllers\JenisIbadahController::class)
    ->middleware(['auth', 'admin'])
    ->names('jenis-ibadah');

Route::resource('warta-gereja', App\Http\Controllers\WartaGerejaController::class)
    ->middleware(['auth', 'admin'])
    ->names('warta-gereja');

Route::resource('data-jemaat', App\Http\Controllers\DataJemaatController::class)
    ->middleware(['auth', 'admin'])
    ->names('data-jemaat');
Route::put('data-jemaat/keluar/{id}', [App\Http\Controllers\DataJemaatController::class, 'keluarDariAnggotaJemaat'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.keluar');

// Routes untuk mengelola tanggal kematian
Route::put('data-jemaat/meninggal-ayah/{id}', [App\Http\Controllers\DataJemaatController::class, 'updateMeninggalAyah'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.meninggal-ayah');
Route::put('data-jemaat/meninggal-ibu/{id}', [App\Http\Controllers\DataJemaatController::class, 'updateMeninggalIbu'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.meninggal-ibu');
Route::put('data-jemaat/reset-ayah/{id}', [App\Http\Controllers\DataJemaatController::class, 'resetMeninggalAyah'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.reset-ayah');
Route::put('data-jemaat/reset-ibu/{id}', [App\Http\Controllers\DataJemaatController::class, 'resetMeninggalIbu'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.reset-ibu');

Route::get('laporan-jemaat', [App\Http\Controllers\DataJemaatController::class, 'laporan'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.laporan');

Route::resource('sekolah-minggu', App\Http\Controllers\SekolahMingguController::class)
    ->middleware(['auth', 'admin'])
    ->names('sekolah-minggu');

// Routes untuk mengelola tanggal kematian sekolah minggu
Route::put('sekolah-minggu/meninggal/{id}', [App\Http\Controllers\SekolahMingguController::class, 'updateMeninggal'])
    ->middleware(['auth', 'admin'])
    ->name('sekolah-minggu.meninggal');
Route::put('sekolah-minggu/reset/{id}', [App\Http\Controllers\SekolahMingguController::class, 'resetMeninggal'])
    ->middleware(['auth', 'admin'])
    ->name('sekolah-minggu.reset');

Route::resource('remaja', App\Http\Controllers\RemajaController::class)
    ->middleware(['auth', 'admin'])
    ->names('remaja');

// Routes untuk mengelola tanggal kematian remaja
Route::put('remaja/meninggal/{id}', [App\Http\Controllers\RemajaController::class, 'updateMeninggal'])
    ->middleware(['auth', 'admin'])
    ->name('remaja.meninggal');
Route::put('remaja/reset/{id}', [App\Http\Controllers\RemajaController::class, 'resetMeninggal'])
    ->middleware(['auth', 'admin'])
    ->name('remaja.reset');

// Route untuk download report PDF kolekte
Route::get('kolekte/download-report', [App\Http\Controllers\KolekteController::class, 'downloadReport'])
    ->middleware(['auth', 'admin'])
    ->name('kolekte.download-report');

Route::resource('kolekte', App\Http\Controllers\KolekteController::class)
    ->middleware(['auth', 'admin'])
    ->names('kolekte');

// Route untuk print data jemaat
Route::get('data-jemaat/{id}/print', [App\Http\Controllers\DataJemaatController::class, 'print'])
    ->middleware(['auth', 'admin'])
    ->name('data-jemaat.print');

Route::resource('template-surat', App\Http\Controllers\TemplateSuratController::class)
    ->middleware(['auth', 'admin'])
    ->names('template-surat');

Route::resource('surat-terbit', App\Http\Controllers\SuratTerbitController::class)
    ->middleware(['auth', 'admin'])
    ->names('surat-terbit');
Route::get('surat-terbit/{id}/download', [App\Http\Controllers\SuratTerbitController::class, 'downloadSurat'])
    ->middleware(['auth', 'admin'])
    ->name('surat-terbit.download');

Route::resource('permohonan-surat', App\Http\Controllers\PermohonanSuratController::class)
    ->middleware(['auth'])
    ->names('permohonan-surat');
Route::get('permohonan/form', [App\Http\Controllers\PermohonanSuratController::class, 'formPermohonanSurat'])
    ->middleware(['auth'])
    ->name('permohonan-surat.form');
Route::post('permohonan/simpan', [App\Http\Controllers\PermohonanSuratController::class, 'simpanPermononanSurat'])
    ->middleware(['auth'])
    ->name('permohonan-surat.simpan');
Route::put('permohonan/tolak/{id}', [App\Http\Controllers\PermohonanSuratController::class, 'tolakPermohonan'])
    ->middleware(['auth', 'admin'])
    ->name('permohonan-surat.tolak');
Route::get('permohonan/anggota-keluarga', [App\Http\Controllers\PermohonanSuratController::class, 'getAnggotaKeluarga'])
    ->middleware(['auth'])
    ->name('permohonan-surat.anggota-keluarga');

Route::prefix('/ucapan-syukur')->group(function () {
    Route::get('/', [App\Http\Controllers\UcapaSyukurController::class, 'index'])->middleware(['auth', 'admin'])->name('ucapan-syukur.index');
    Route::get('submit', [App\Http\Controllers\UcapaSyukurController::class, 'formUcapanSyukur'])->name('ucapan-syukur.submit');
    Route::post('submit', [App\Http\Controllers\UcapaSyukurController::class, 'submitUcapanSyukur'])->name('ucapan-syukur.submit.post');
    Route::put('terima/{id}', [App\Http\Controllers\UcapaSyukurController::class, 'terima'])->middleware(['auth', 'admin'])->name('ucapan-syukur.terima');
    Route::put('tolak/{id}', [App\Http\Controllers\UcapaSyukurController::class, 'tolak'])->middleware(['auth', 'admin'])->name('ucapan-syukur.tolak');
});
