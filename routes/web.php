<?php

use App\Http\Controllers\AutentikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('login', [AutentikasiController::class, 'login'])->name('login');
Route::post('login', [AutentikasiController::class, 'prosesLogin'])->name('prosesLogin');
Route::post('logout', [AutentikasiController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::get('dashboard', [AutentikasiController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('dashboard');

Route::resource('admin', App\Http\Controllers\AdminController::class)
    ->middleware(['auth', 'admin'])
    ->names('admin');

Route::resource('tamu', App\Http\Controllers\TamuController::class)
    ->middleware(['auth', 'admin'])
    ->names('tamu');


