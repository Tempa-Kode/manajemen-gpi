<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pendaftar Ibadah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }
        
        .header h2 {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }
        
        .info-box {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .info-row {
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .text-center {
            text-align: center;
        }
        
        .summary-box {
            background: #e9ecef;
            border: 1px solid #adb5bd;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .summary-item {
            margin-bottom: 5px;
        }
        
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>GPI SIDANG PERAWANG</h1>
        <h2>DATA PENDAFTAR IBADAH</h2>
    </div>

    <div class="info-box">
        <div class="info-row">
            <span class="info-label">Jenis Ibadah:</span>
            <span>{{ $jadwalIbadah->jenisIbadah->jenis_ibadah }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Hari/Tanggal:</span>
            <span>{{ $jadwalIbadah->hari }}, {{ \Carbon\Carbon::parse($jadwalIbadah->tanggal)->translatedFormat('d F Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Jam:</span>
            <span>{{ \Carbon\Carbon::parse($jadwalIbadah->jam)->format('H:i') }} WIB</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tempat:</span>
            <span>{{ $jadwalIbadah->tempat }}</span>
        </div>
        @if($jadwalIbadah->alamat)
        <div class="info-row">
            <span class="info-label">Alamat:</span>
            <span>{{ $jadwalIbadah->alamat }}</span>
        </div>
        @endif
    </div>

    <div class="summary-box">
        <div class="summary-item">
            <strong>Total Pendaftar: {{ $jadwalIbadah->pendaftarIbadah->count() }} orang</strong>
        </div>
        <div class="summary-item">
            Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
        </div>
    </div>

    @if($jadwalIbadah->pendaftarIbadah->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Pendaftar</th>
                <th width="25%">Email</th>
                <th width="15%">Tanggal Daftar</th>
                <th width="30%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalIbadah->pendaftarIbadah as $index => $pendaftar)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $pendaftar->user->name }}</td>
                <td>{{ $pendaftar->user->email }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($pendaftar->created_at)->translatedFormat('d/m/Y') }}</td>
                <td>{{ $pendaftar->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        <p>Belum ada pendaftar untuk jadwal ibadah ini.</p>
    </div>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
        <p>Sistem Manajemen GPI Sidang Perawang</p>
    </div>
</body>
</html>
