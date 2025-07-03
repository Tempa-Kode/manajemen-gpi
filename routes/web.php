<?php

use App\Http\Controllers\AutentikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AutentikasiController::class, 'login'])->name('login');
