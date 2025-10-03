<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kolekte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }
        .logo-cell {
            width: 15%;
            text-align: left;
        }
        .logo-cell img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
        .title-cell {
            width: 85%;
            text-align: center;
        }
        .title-cell h1 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }
        .title-cell h2 {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
            font-weight: normal;
        }
        .period {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }
        .number {
            text-align: right;
        }
        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .grand-total {
            background-color: #d4edda;
            font-weight: bold;
            font-size: 14px;
        }
        .summary {
            margin-top: 20px;
            border: 2px solid #333;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .summary h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .signature-section {
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }
        .signature-table td {
            border: none;
            vertical-align: top;
        }
        .signature-left {
            width: 50%;
        }
        .signature-right {
            width: 50%;
            text-align: center;
            padding-left: 20px;
        }
        .signature-content p {
            margin: 5px 0;
            font-size: 12px;
            color: #333;
        }
        .signature-title {
            font-weight: bold;
            margin-bottom: 10px !important;
        }
        .signature-space {
            height: 60px;
            margin: 15px 0;
        }
        .signature-space img {
            margin-top: -20px;
            width: 50%;
            /* height: 100%; */
            object-fit: contain;
        }
        .signature-name {
            /* border-bottom: 1px solid #333; */
            margin: 0 20px;
            padding-bottom: 2px;
            font-weight: bold;
        }
        .signature-subtitle {
            font-size: 10px !important;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('assets/img/logo-gpi.png') }}" alt="Logo GPI">
                </td>
                <td class="title-cell">
                    <h1>GEREJA PENTAKOSTA INDONESIA</h1>
                    <h2>SIDANG PERAWANG</h2>
                    <h2>LAPORAN KOLEKTE</h2>
                </td>
            </tr>
        </table>
    </div>

    <div class="period">
        @if($filterType === 'month')
            @php
                $dateParts = explode('-', $filterValue);
                $year = $dateParts[0];
                $month = isset($dateParts[1]) ? $dateParts[1] : '01';
                $carbonDate = \Carbon\Carbon::createFromDate($year, $month, 1);
            @endphp
            Periode: {{ $carbonDate->locale('id')->isoFormat('MMMM Y') }}
        @else
            Periode: Tahun {{ $filterValue }}
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="12%">Tanggal Ibadah</th>
                <th width="15%">Jenis Ibadah</th>
                <th width="17%">Pembangunan Gereja</th>
                <th width="17%">Pelayanan Pengerja</th>
                <th width="17%">Pelayanan Sosial</th>
                <th width="17%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kolektes as $index => $kolekte)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">{{ $kolekte->tanggal_ibadah ? $kolekte->tanggal_ibadah->format('d/m/Y') : '-' }}</td>
                <td>{{ $kolekte->jadwalIbadah->jenisIbadah->jenis_ibadah ?? 'Umum' }}</td>
                <td class="number">Rp {{ number_format($kolekte->pembangunan_gereja, 0, ',', '.') }}</td>
                <td class="number">Rp {{ number_format($kolekte->persembahan_pelayanan_pengerja, 0, ',', '.') }}</td>
                <td class="number">Rp {{ number_format($kolekte->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}</td>
                <td class="number">Rp {{ number_format($kolekte->pembangunan_gereja + $kolekte->persembahan_pelayanan_pengerja + $kolekte->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; font-style: italic; color: #666;">Tidak ada data kolekte pada periode ini</td>
            </tr>
            @endforelse

            @if($kolektes->count() > 0)
            <tr class="grand-total">
                <td colspan="3" style="text-align: center;"><strong>TOTAL KESELURUHAN</strong></td>
                <td class="number"><strong>Rp {{ number_format($totalPembangunan, 0, ',', '.') }}</strong></td>
                <td class="number"><strong>Rp {{ number_format($totalPengerja, 0, ',', '.') }}</strong></td>
                <td class="number"><strong>Rp {{ number_format($totalSosial, 0, ',', '.') }}</strong></td>
                <td class="number"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
            </tr>
            @endif
        </tbody>
    </table>

    @if($kolektes->count() > 0)
    <div class="summary">
        <h3>RINGKASAN KOLEKTE</h3>
        <div class="summary-item">
            <span>Total Pembangunan Gereja:</span>
            <span><strong>Rp {{ number_format($totalPembangunan, 0, ',', '.') }}</strong></span>
        </div>
        <div class="summary-item">
            <span>Total Persembahan Pelayanan Pengerja:</span>
            <span><strong>Rp {{ number_format($totalPengerja, 0, ',', '.') }}</strong></span>
        </div>
        <div class="summary-item">
            <span>Total Persembahan Pelayanan Sosial Gereja:</span>
            <span><strong>Rp {{ number_format($totalSosial, 0, ',', '.') }}</strong></span>
        </div>
        <hr>
        <div class="summary-item" style="font-size: 14px;">
            <span><strong>GRAND TOTAL:</strong></span>
            <span><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></span>
        </div>
        <div class="summary-item" style="margin-top: 10px;">
            <span>Jumlah Data:</span>
            <span><strong>{{ $kolektes->count() }} entri</strong></span>
        </div>
    </div>
    @endif

    <div class="footer">
        Dicetak pada: {{ now()->locale('id')->isoFormat('dddd, D MMMM Y HH:mm') }} WIB
    </div>

    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td class="signature-left"></td>
                <td class="signature-right">
                    <div class="signature-content">
                        <p>Perawang, {{ now()->locale('id')->isoFormat('D MMMM Y') }}</p>
                        <p class="signature-title">Bendahara Gereja</p>
                        <div class="signature-space">
                            <img src="{{ public_path('assets/img/ttd-bendahara.png') }}" alt="Logo GPI">
                        </div>
                        <p class="signature-name">(NONSTA SITINJAK)</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
