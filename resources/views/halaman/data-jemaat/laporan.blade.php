<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Jemaat</title>
    <style>
        /* DomPDF-compatible styles */
        @page {
            margin: 36px 32px;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header {
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            border: none;
            vertical-align: middle;
            padding: 10px;
        }

        .header-table .logo-cell {
            width: 15%;
            text-align: left;
        }

        .header-table .content-cell {
            width: 70%;
            text-align: center;
        }

        .header-table .space-cell {
            width: 15%;
        }

        .header .title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .header .subtitle {
            font-size: 13px;
            color: #555;
            margin-top: 4px;
        }

        .meta {
            margin-top: 6px;
            font-size: 11px;
            color: #333;
        }

        .line {
            border-top: 2px solid #222;
            margin: 8px 0 12px;
        }

        table.report {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            table-layout: fixed;
        }

        table.report thead th {
            background: #0d6efd;
            color: #fff;
            padding: 10px 8px;
            font-weight: 700;
            border: 1px solid #d6e0f5;
            text-align: left;
        }

        table.report thead th.center {
            text-align: center;
        }

        table.report tbody td {
            padding: 10px 8px;
            border: 1px solid #e6eefc;
            vertical-align: top;
            word-wrap: break-word;
            white-space: normal;
        }

        table.report tbody tr:nth-child(even) td {
            background: #fbfdff;
        }

        table.report tbody tr.no-data td {
            text-align: center;
            color: #666;
            padding: 18px;
        }

        /* compact lists inside table cells */
        table.report td ul {
            margin: 0;
            padding-left: 16px;
        }

        table.report td ul li {
            margin: 2px 0;
            padding: 0;
            line-height: 1.25;
        }

        .footer {
            position: fixed;
            bottom: -18px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #666;
        }

        .small {
            font-size: 11px;
            color: #666;
        }

        /* column widths (use classes on th/td) */
        .c-no {
            width: 4%;
        }

        .c-idkk {
            width: 8%;
        }

        .c-nama {
            width: 20%;
        }

        .c-ayah {
            width: 12%;
        }

        .c-ibu {
            width: 12%;
        }

        .c-remaja {
            width: 18%;
        }

        .c-sm {
            width: 15%;
        }
    </style>
</head>

<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('assets/img/logo-gpi.png') }}" alt="Logo" style="height:80px;">
                </td>
                <td class="content-cell">
                    <strong class="title">GPI Sidang Perawang</strong>
                    <div class="subtitle">Laporan Data Jemaat</div>
                    <div class="meta">Dicetak: {{ date("d M Y") }}</div>
                </td>
                <td class="space-cell">
                    <!-- Empty cell for balance -->
                </td>
            </tr>
        </table>
    </div>

    <div class="line"></div>

    <table class="report">
        <thead>
            <tr>
                <th class="c-no center">No</th>
                <th class="c-idkk center">Id KK</th>
                <th class="c-nama">Nama Keluarga</th>
                <th class="c-ayah">Ayah</th>
                <th class="c-ibu">Ibu</th>
                <th class="c-remaja">Remaja</th>
                <th class="c-sm">Anak Sekolah Minggu</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jemaat as $item)
                <tr>
                    <td class="c-no center">{{ $loop->iteration }}</td>
                    <td class="c-idkk center">{{ $item->id_kk }}</td>
                    <td class="c-nama">{{ $item->nama_keluarga }}</td>
                    <td class="c-ayah">{{ $item->ayah ?? "-" }}</td>
                    <td class="c-ibu">{{ $item->ibu ?? "-" }}</td>
                    <td class="c-remaja">
                        <ul>
                            @forelse ($item->remaja as $remaja)
                                <li>{{ $remaja->nama }}</li>
                            @empty
                                <li>Tidak ada data</li>
                            @endforelse
                        </ul>
                    </td>
                    <td class="c-sm">
                        <ul>
                            @forelse ($item->sekolahMinggu as $sm)
                                <li>{{ $sm->nama }}</li>
                            @empty
                                <li>Tidak ada data</li>
                            @endforelse
                        </ul>
                    </td>
                </tr>
            @empty
                <tr class="no-data">
                    <td colspan="7">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="small">GPI Sidang Perawang — Manajemen Data Remaja</div>
    </div>

    {{-- DomPDF page numbering (will be processed by DomPDF when rendering) --}}
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->getFont('DejaVu Sans', 'normal');
            $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", $font, 10, array(0,0,0));
        }
    </script>
</body>

</html>
