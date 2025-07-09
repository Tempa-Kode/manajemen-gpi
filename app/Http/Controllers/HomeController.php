<?php

namespace App\Http\Controllers;

use App\Models\JenisIbadah;
use App\Models\JadwalIbadah;
use App\Models\PendaftaranIbadah;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }

    public function tentangGereja()
    {
        return view('landing.tentang-gereja');
    }

    public function strukturGereja()
    {
        return view('landing.struktur-gereja');
    }

    public function jadwalPelayanan()
    {
        // Ambil tanggal awal dan akhir bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Ambil semua jenis ibadah dengan jadwal ibadah dalam bulan ini
        $jenisIbadah = JenisIbadah::with(['jadwalIbadah' => function($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
              ->orderBy('tanggal', 'asc')
              ->orderBy('jam', 'asc');
        }])->orderBy('jenis_ibadah')->get();

        // Ambil semua jadwal ibadah bulan ini untuk overview
        $jadwalBulanIni = JadwalIbadah::with('jenisIbadah')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        Carbon::setLocale('id');
        $bulanIni = Carbon::now()->translatedFormat('F Y');

        return view('landing.jadwal-pelayanan', compact('jenisIbadah', 'jadwalBulanIni', 'bulanIni'));
    }

    public function pendaftaranIbadah()
    {
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

    public function cancelPendaftaranIbadah($id)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->back()
                ->with('error', 'Anda harus login terlebih dahulu.')
                ->withInput();
        }

        try {
            // Cari pendaftaran berdasarkan ID dan pastikan milik user yang sedang login
            $pendaftaran = PendaftaranIbadah::with('jadwalIbadah')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$pendaftaran) {
                return redirect()->back()
                    ->with('error', 'Pendaftaran tidak ditemukan atau bukan milik Anda.');
            }

            // Cek apakah masih bisa dibatalkan (minimal 1 hari sebelum ibadah)
            $tanggalIbadah = Carbon::parse($pendaftaran->jadwalIbadah->tanggal);
            $jamIbadah = Carbon::parse($pendaftaran->jadwalIbadah->jam);

            // Gabungkan tanggal dan jam ibadah
            $waktuIbadah = $tanggalIbadah->setTimeFromTimeString($jamIbadah->format('H:i:s'));

            // Batas waktu pembatalan: 1 hari (24 jam) sebelum ibadah
            $batasWaktu = $waktuIbadah->copy()->subHours(24);

            if (Carbon::now()->greaterThanOrEqualTo($batasWaktu)) {
                return redirect()->back()
                    ->with('error', 'Pendaftaran tidak dapat dibatalkan karena sudah melewati batas waktu pembatalan (H-1 atau 24 jam sebelum ibadah).');
            }

            // Hapus pendaftaran
            $pendaftaran->delete();

            return redirect()->route('pendaftaranIbadah')
                ->with('success', 'Pendaftaran ibadah berhasil dibatalkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat membatalkan pendaftaran: ' . $e->getMessage());
        }
    }
}
