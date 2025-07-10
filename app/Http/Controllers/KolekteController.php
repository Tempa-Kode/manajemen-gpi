<?php

namespace App\Http\Controllers;

use App\Models\Kolekte;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class KolekteController extends Controller
{
    public function index()
    {
        $kolektes = Kolekte::with('jadwalIbadah')->latest()->get();
        return view('halaman.kolekte.index', compact('kolektes'));
    }

    public function create()
    {
        $jadwalIbadahs = JadwalIbadah::with('jenisIbadah')->get();
        return view('halaman.kolekte.create', compact('jadwalIbadahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_ibadah_id' => 'nullable|exists:jadwal_ibadah,id',
            'tanggal_ibadah' => 'required|date',
            'pembangunan_gereja' => 'required|numeric|min:0',
            'persembahan_pelayanan_pengerja' => 'required|numeric|min:0',
            'persembahan_pelayanan_sosial_gereja' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        Kolekte::create($request->all());

        return redirect()->route('kolekte.index')
            ->with('success', 'Data kolekte berhasil ditambahkan.');
    }

    public function show(Kolekte $kolekte)
    {
        $kolekte->load('jadwalIbadah');
        // dd($kolekte); // Uncomment this line to debug and see the kolekte data
        return view('halaman.kolekte.show', compact('kolekte'));
    }

    public function edit(Kolekte $kolekte)
    {
        $jadwalIbadahs = JadwalIbadah::with('jenisIbadah')->get();
        return view('halaman.kolekte.edit', compact('kolekte', 'jadwalIbadahs'));
    }

    public function update(Request $request, Kolekte $kolekte)
    {
        $request->validate([
            'jadwal_ibadah_id' => 'nullable|exists:jadwal_ibadah,id',
            'tanggal_ibadah' => 'required|date',
            'pembangunan_gereja' => 'required|numeric|min:0',
            'persembahan_pelayanan_pengerja' => 'required|numeric|min:0',
            'persembahan_pelayanan_sosial_gereja' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $kolekte->update($request->all());

        return redirect()->route('kolekte.index')
            ->with('success', 'Data kolekte berhasil diperbarui.');
    }

    public function destroy(Kolekte $kolekte)
    {
        $kolekte->delete();

        return redirect()->route('kolekte.index')
            ->with('success', 'Data kolekte berhasil dihapus.');
    }

    public function downloadReport(Request $request)
    {
        $request->validate([
            'filter_type' => 'required|in:month,year',
            'filter_value' => 'required'
        ]);

        $filterType = $request->filter_type;
        $filterValue = $request->filter_value;

        // Query data berdasarkan filter
        $query = Kolekte::with('jadwalIbadah.jenisIbadah');

        if ($filterType === 'month') {
            // Format: 2025-07 -> ubah ke 2025-7 jika perlu
            $filterValue = str_replace('-0', '-', $filterValue); // Handle 2025-07 -> 2025-7
            $parts = explode('-', $filterValue);
            $year = $parts[0];
            $month = ltrim($parts[1], '0'); // Remove leading zero
            $query->whereYear('tanggal_ibadah', $year)
                  ->whereMonth('tanggal_ibadah', $month);
        } else {
            // Filter berdasarkan tahun
            $query->whereYear('tanggal_ibadah', $filterValue);
        }

        $kolektes = $query->orderBy('tanggal_ibadah', 'asc')->get();

        // Hitung total
        $totalPembangunan = $kolektes->sum('pembangunan_gereja');
        $totalPengerja = $kolektes->sum('persembahan_pelayanan_pengerja');
        $totalSosial = $kolektes->sum('persembahan_pelayanan_sosial_gereja');
        $grandTotal = $totalPembangunan + $totalPengerja + $totalSosial;

        try {
            // Generate PDF
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('halaman.kolekte.report-pdf', compact(
                'kolektes',
                'filterType',
                'filterValue',
                'totalPembangunan',
                'totalPengerja',
                'totalSosial',
                'grandTotal'
            ));

            $filename = 'laporan-kolekte-' . str_replace('-', '_', $filterValue) . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }
}
