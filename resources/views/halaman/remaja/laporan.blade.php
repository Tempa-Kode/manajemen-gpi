<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Remaja</title>
    <style>
        /* DomPDF-compatible styles */
        @page {
            margin: 40px 40px;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
        }

        .header .title {
            font-size: 18px;
            font-weight: 700;
        }

        .header .subtitle {
            font-size: 12px;
            color: #555;
            margin-top: 4px
        }

        .meta {
            margin-top: 8px;
            font-size: 11px;
            color: #333;
        }

        .line {
            border-top: 2px solid #333;
            margin: 8px 0 14px;
        }

        table.report {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        table.report thead td {
            background: #0d6efd;
            color: #fff;
            padding: 8px;
            font-weight: 700;
            border: 1px solid #ddd;
        }

        table.report tbody td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        table.report tbody tr:nth-child(even) td {
            background: #f7fbff;
        }

        table.report tbody tr.no-data td {
            text-align: center;
            color: #666;
            padding: 18px;
        }

        .footer {
            position: fixed;
            bottom: -20px;
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

        /* column widths */
        .c-no {
            width: 6%;
        }

        .c-nama {
            width: 36%;
        }

        .c-jk {
            width: 12%;
        }

        .c-pendidikan {
            width: 23%;
        }

        .c-pekerjaan {
            width: 23%;
        }
    </style>
</head>

<body>
    <div class="header">
        <div style="display:flex;align-items:center;justify-content:center;gap:12px;">
            <!-- optional logo area; replace with an <img> tag if you have a logo -->
            <div style="text-align:center;">
                <strong class="title">GPI Sidang Perawang</strong>
                <div class="subtitle">Laporan Data Remaja</div>
            </div>
        </div>
        <div class="meta">Dicetak: {{ date("d M Y") }}</div>
    </div>

    <div class="line"></div>

    <table class="report">
        <thead>
            <tr>
                <td class="c-no">No</td>
                <td class="c-nama">Nama</td>
                <td class="c-jk">Jenis Kelamin</td>
                <td class="c-pendidikan">Pendidikan</td>
                <td class="c-pekerjaan">Pekerjaan</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($remaja as $item)
                <tr>
                    <td class="c-no">{{ $loop->iteration }}</td>
                    <td class="c-nama">{{ $item->nama }}</td>
                    <td class="c-jk">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="c-pendidikan">{{ $item->pendidikan ?? "-" }}</td>
                    <td class="c-pekerjaan">{{ $item->pekerjaan ?? "-" }}</td>
                </tr>
            @empty
                <tr class="no-data">
                    <td colspan="5">Tidak ada data</td>
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
