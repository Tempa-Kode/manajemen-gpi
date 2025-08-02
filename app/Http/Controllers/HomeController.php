<?php

namespace App\Http\Controllers;

use App\Models\JenisIbadah;
use App\Models\JadwalIbadah;
use App\Models\PendaftaranIbadah;
use App\Models\User;
use App\Models\WartaGereja;
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

    public function wartaGereja()
    {
        // Ambil semua warta gereja, urutkan dari yang terbaru
        $wartaGereja = WartaGereja::orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('landing.warta-gereja', compact('wartaGereja'));
    }

    public function detailWartaGereja($id)
    {
        // Ambil detail warta gereja berdasarkan ID
        $warta = WartaGereja::findOrFail($id);

        return view('landing.detail-warta-gereja', compact('warta'));
    }

    public function profilJemaat()
    {
        $user = Auth::user()->id;
        $jemaat = User::findOrFail($user);
        return view('landing.profil-jemaat', compact('jemaat'));
    }
}
