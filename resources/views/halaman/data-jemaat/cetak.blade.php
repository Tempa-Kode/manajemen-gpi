<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kartu Keluarga - {{ $data->nama_keluarga }}</title>
    <style>
        /* DomPDF-friendly styles for a Kartu Keluarga layout */
        @page {
            margin: 30px 28px;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            color: #222;
            font-size: 12px;
        }

        .kk-card {
            border: 1px solid #cfd8e3;
            padding: 14px;
        }

        .kk-header {
            text-align: center;
            margin-bottom: 8px;
        }

        .kk-header .church {
            font-weight: 800;
            font-size: 16px;
        }

        .kk-header .title {
            font-size: 14px;
            margin-top: 4px;
            color: #333;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin: 10px 0;
        }

        .meta-col {
            width: 48%;
        }

        .meta-label {
            font-weight: 700;
            font-size: 11px;
            color: #333;
        }

        .meta-value {
            margin-top: 6px;
            font-size: 13px;
            color: #111;
        }

        table.members {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            table-layout: fixed;
        }

        table.members th,
        table.members td {
            border: 1px solid #e3eefc;
            padding: 8px 6px;
            vertical-align: top;
        }

        table.members th {
            background: #0d6efd;
            color: #fff;
            font-weight: 700;
            text-align: left;
        }

        table.members tbody tr:nth-child(even) td {
            background: #fbfdff;
        }

        table.members td ul {
            margin: 0;
            padding-left: 16px;
        }

        .notes {
            margin-top: 10px;
            font-size: 11px;
            color: #555;
        }

        .footer {
            position: fixed;
            bottom: -12px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="kk-card">
        <div class="kk-header">
            <div class="church">GPI Sidang Perawang</div>
            <div class="title">Kartu Keluarga (Data Jemaat)</div>
            <div class="small">Dicetak: {{ date("d M Y") }}</div>
        </div>

        <div class="meta-row">
            <div class="meta-col">
                <div class="meta-label">ID KK</div>
                <div class="meta-value">{{ $data->id_kk ?? "-" }}</div>

                <div class="meta-label" style="margin-top:8px;">Nama Keluarga / Kepala Keluarga</div>
                <div class="meta-value">{{ $data->nama_keluarga }}</div>

                <div class="meta-label" style="margin-top:8px;">Alamat</div>
                <div class="meta-value">{{ $data->alamat }}</div>
            </div>

        </div>

        <table class="members">
            <thead>
                <tr>
                    <th style="width:6%;">No</th>
                    <th style="width:32%;">Nama</th>
                    <th style="width:12%;">Jenis Kelamin</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($data->ayah) || isset($data->ibu))
                    <tr>
                        <td>1</td>
                        <td>{{ $data->ayah }}</td>
                        <td>Laki-Laki</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td style="font-style: italic;">{{ $data->ibu ?? 'belum di isi' }}</td>
                        <td>Perempuan</td>
                    </tr>
                @else
                    @if (isset($data->ayah))
                        <tr>
                            <td>1</td>
                            <td>{{ $data->ayah }}</td>
                            <td>Laki-Laki</td>
                        </tr>
                    @else
                        <tr>
                            <td>1</td>
                            <td>{{ $data->ibu }}</td>
                            <td>Perempuan</td>
                        </tr>
                    @endif
                @endif

                @if (isset($data->remaja))
                    @foreach ($data->remaja as $r)
                        <tr>
                            <td>{{ $loop->iteration + 2 }}</td>
                            <td>{{ $r->nama }}</td>
                            <td>{{ $r->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        </tr>
                    @endforeach
                @endif

                @if (isset($data->sekolahMinggu))
                    @foreach ($data->sekolahMinggu as $sm)
                        <tr>
                            <td>{{ $loop->iteration + (isset($data->remaja) ? count($data->remaja) + 2 : 2) }}</td>
                            <td>{{ $sm->nama }}</td>
                            <td>{{ $sm->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        </tr>
                    @endforeach

                @endif


                {{-- @forelse($members as $m)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $m->nama ?? ($m->full_name ?? "-") }}</td>
                        <td>{{ $m->jenis_kelamin ?? ($m->jk ?? "-") }}</td>
                        <td>{{ isset($m->tempat_lahir) || isset($m->tanggal_lahir) ? trim(($m->tempat_lahir ?? "") . ", " . ($m->tanggal_lahir ?? "")) : "-" }}
                        </td>
                        <td>
                            @if (isset($m->pendidikan) || isset($m->pekerjaan))
                                {{ $m->pendidikan ?? "-" }}
                                @if (isset($m->pekerjaan))
                                    <br>{{ $m->pekerjaan }}
                                @endif
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#666;padding:14px;">Tidak ada anggota
                            terdaftar</td>
                    </tr>
                @endforelse --}}
            </tbody>
        </table>
    </div>

    <div class="footer">GPI Sidang Perawang — Manajemen Jemaat</div>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->getFont('DejaVu Sans', 'normal');
            $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", $font, 9, array(0,0,0));
        }
    </script>
</body>

</html>
