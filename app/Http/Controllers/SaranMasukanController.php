<?php

namespace App\Http\Controllers;

use App\Models\SaranMasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranMasukanController extends Controller
{
    public function index()
    {
        $data = SaranMasukan::latest()->get();
        return view('halaman.saran-masukan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'subjek' => 'required|string|max:150',
            'pesan' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            SaranMasukan::create($validasi);
            DB::commit();
            return redirect()->back()->with('success', 'Saran & masukan Anda telah dikirim. Terima kasih!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim saran & masukan. Silakan coba lagi.');
        }
    }
}
