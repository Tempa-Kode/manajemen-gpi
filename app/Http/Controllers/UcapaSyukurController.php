<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\UcapanSyukur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UcapaSyukurController extends Controller
{
    public function index()
    {
        $data = UcapanSyukur::latest()->get();

        // mengambil data ucapan syukur dalam bulan ini, dan menghitung nominal
        $bulanIni = UcapanSyukur::whereMonth('created_at', now()->month)->get();
        $totalBulanIni = $bulanIni->sum('nominal');

        // mengambil data ucapan syukur dalam minggu ini (gunakan rentang tanggal untuk menghindari fungsi WEEK() yang bermasalah)
        $now = now();
        $startOfWeek = $now->copy()->startOfWeek(); // default mulai Senin; ganti jika perlu
        $endOfWeek = $now->copy()->endOfWeek();
        $mingguIni = UcapanSyukur::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
        $totalMingguIni = $mingguIni->sum('nominal');

        // mengambil data ucapan syukur dalam tahun ini
        $tahunIni = UcapanSyukur::whereYear('created_at', now()->year)->get();
        $totalTahunIni = $tahunIni->sum('nominal');

        return view(
            'halaman.ucapan-syukur.index',
            compact('data', 'totalBulanIni', 'totalMingguIni', 'totalTahunIni')
        );
    }

    public function formUcapanSyukur()
    {
        return view('landing.ucapan-syukur');
    }

    public function submitUcapanSyukur(Request $request)
    {
        $validasi = $request->validate([
            'nama' => ['nullable', 'max:50'],
            'no_hp' => ['nullable', 'max:15'],
            'nominal' => ['required', 'numeric'],
            'bukti_transfer' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ], [
            'nama.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'no_hp.max' => 'Nomor handphone tidak boleh lebih dari :max karakter.',
            'nominal.required' => 'Nominal harus diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'bukti_transfer.required' => 'Bukti transfer harus diunggah.',
            'bukti_transfer.image' => 'Bukti transfer harus berupa file gambar.',
            'bukti_transfer.mimes' => 'Bukti transfer harus berformat :values.',
            'bukti_transfer.max' => 'Ukuran file bukti transfer tidak boleh lebih dari :max kilobyte.'
        ]);

        DB::beginTransaction();
        try {

            $file = $request->file('bukti_transfer');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $destination = public_path('storage/bukti_transfer');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            // simpan path relatif: storage/bukti_transfer/xxx.jpg
            $validasi['bukti_transfer'] = 'storage/bukti_transfer/' . $filename;

            UcapanSyukur::create($validasi);

            DB::commit();

            return redirect()->back()->with('success', 'Ucapan syukur berhasil dikirim. Terima kasih.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan. Silakan coba lagi.');
        }
    }
}
