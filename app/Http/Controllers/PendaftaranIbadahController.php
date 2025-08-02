<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use App\Models\JenisIbadah;
use App\Models\PendaftaranIbadah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranIbadahController extends Controller
{
    public function halamanPendaftaranIbadah() {
        // Ambil semua jenis ibadah
        $jenisIbadah = JenisIbadah::all();

        // Ambil jadwal ibadah yang akan datang
        $jadwalIbadah = JadwalIbadah::with('jenisIbadah')
            ->where('tanggal', '>=', Carbon::now())
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        // Ambil pendaftaran ibadah yang sudah ada untuk user yang login
        $pendaftaranExisting = collect();
        if (Auth::check()) {
            $pendaftaranExisting = PendaftaranIbadah::with(['jadwalIbadah.jenisIbadah'])
                ->where('user_id', Auth::id())
                ->whereHas('jadwalIbadah', function($query) {
                    $query->where('tanggal', '>=', Carbon::now());
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('landing.pendaftaran-ibadah', compact('jenisIbadah', 'jadwalIbadah', 'pendaftaranExisting'));
    }

    public function storePendaftaranIbadah(Request $request)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->back()
                ->with('error', 'Anda harus login terlebih dahulu untuk mendaftar ibadah.')
                ->withInput();
        }

        $request->validate([
            'jadwal_ibadah_id' => 'required|exists:jadwal_ibadah,id',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'jadwal_ibadah_id.required' => 'Jadwal ibadah harus dipilih',
            'jadwal_ibadah_id.exists' => 'Jadwal ibadah yang dipilih tidak valid',
        ]);

        try {
            $user = Auth::user();

            // Cek apakah user sudah mendaftar untuk jadwal ibadah ini
            $existingRegistration = PendaftaranIbadah::where('user_id', $user->id)
                ->where('jadwal_ibadah_id', $request->jadwal_ibadah_id)
                ->first();

            if ($existingRegistration) {
                return redirect()->back()
                    ->with('error', 'Anda sudah terdaftar untuk jadwal ibadah ini')
                    ->withInput();
            }

            // Simpan pendaftaran ibadah
            PendaftaranIbadah::create([
                'user_id' => $user->id,
                'jadwal_ibadah_id' => $request->jadwal_ibadah_id,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('pendaftaranIbadah')
                ->with('success', 'Pendaftaran ibadah berhasil! Terima kasih atas partisipasi Anda.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan pendaftaran: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function konfirmasi($id)
    {
        try {
            $pendaftaran = PendaftaranIbadah::where('id', $id)->first();
            $pendaftaran->status = 'konfirmasi';
            $pendaftaran->save();

            return redirect()->back()->with('success', 'Pendaftaran ibadah berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengkonfirmasi pendaftaran: ' . $e->getMessage());
        }
    }

    public function tolak($id)
    {
        try {
            $pendaftaran = PendaftaranIbadah::where('id', $id)->first();
            $pendaftaran->status = 'tolak';
            $pendaftaran->save();

            return redirect()->back()->with('success', 'Pendaftaran ibadah berhasil ditolak.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menolak pendaftaran: ' . $e->getMessage());
        }
    }
}
