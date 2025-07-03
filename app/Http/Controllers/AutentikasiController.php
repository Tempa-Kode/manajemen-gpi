<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutentikasiController extends Controller
{
    public function login() {
        return view('user.login');
    }
}
