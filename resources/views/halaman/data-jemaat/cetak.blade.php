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
            padding: 0;
            background: white;
        }

        .kk-content {
            padding: 20px;
        }

        .kk-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            padding: 20px;
            border-bottom: 3px solid #0d6efd;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }

        .kk-header::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: #ffc107;
        }

        .logo-container {
            flex: 0 0 80px;
            margin-right: 25px;
        }

        .logo-container img {
            width: 75px;
            height: 75px;
            object-fit: contain;
            border: 2px solid #0d6efd;
            border-radius: 50%;
            padding: 5px;
            background: white;
            display: block;
        }

        /* Fallback jika gambar tidak bisa dimuat */
        .logo-placeholder {
            width: 75px;
            height: 75px;
            border: 2px solid #0d6efd;
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #0d6efd;
            font-size: 14px;
        }

        .header-text {
            flex: 1;
            text-align: left;
        }

        .kk-header .church {
            font-weight: 800;
            font-size: 25px;
            text-transform: uppercase;
            text-align: center;
            color: #0d6efd;
            margin: 0;
            line-height: 1.2;
            letter-spacing: 1px;
        }

        .kk-header .title {
            font-size: 20px;
            margin-top: 8px;
            color: #333;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .kk-header .subtitle {
            font-size: 15px;
            color: #666;
            margin-top: 2px;
            font-style: italic;
            text-align: center;
        }

        .contact-info {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 9px;
            color: #666;
            text-align: right;
            line-height: 1.3;
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
            <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
                <tr>
                    <td width="20%" style="text-align: center; vertical-align: top;">
                        <div class="logo-container">
                            @if (file_exists(public_path("assets/img/logo-gpi.png")))
                                <img src="{{ public_path("assets/img/logo-gpi.png") }}" alt="Logo GPI">
                            @else
                                <div class="logo-placeholder">GPI</div>
                            @endif
                        </div>
                    </td>
                    <td width="50%" style="text-align: center; vertical-align: top;">
                        <div class="header-text">
                            <div class="church">Gereja Pentakosta Indonesia</div>
                            <div class="subtitle">Sidang Perawang</div>
                            <div class="title">Kartu Keluarga</div>
                        </div>
                    </td>
                    <td width="30%" style="text-align: right; vertical-align: top;">
                        <div class="contact-info">
                            Jl. Pery No. 36 Km. 3 Perawang<br>
                            Tualang, Kabupaten Siak, Riau<br>
                            Telp: 082267087169<br>
                            Email: info@gpi.org
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="kk-content">
            <table>
                <tr></tr>
                <td>ID KK</td>
                <td>:</td>
                <td>{{ $data->id_kk ?? "-" }}</td>
                </tr>
                <tr>
                    <td>Nama Keluarga</td>
                    <td>:</td>
                    <td>{{ $data->nama_keluarga }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $data->alamat }}</td>
                </tr>
            </table>

            <table class="members">
                <thead>
                    <tr>
                        <th style="width:3%;">No</th>
                        <th style="width:32%;">Nama</th>
                        <th style="width:12%;">Jenis Kelamin</th>
                        <th style="width:12%;">Tempat Lahir</th>
                        <th style="width:12%;">Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($data->ayah) || isset($data->ibu))
                        <tr>
                            <td>1</td>
                            <td>{{ $data->ayah }}</td>
                            <td>Laki-Laki</td>
                            <td>{{ $data->tempat_lahir_ayah ?? "-" }}</td>
                            <td>{{ $data->tgl_lahir_ayah ? \Carbon\Carbon::parse($data->tgl_lahir_ayah)->format("d-m-Y") : "-" }}
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>{{ $data->ibu ?? "belum di isi" }}</td>
                            <td>Perempuan</td>
                            <td>{{ $data->tempat_lahir_ibu ?? "-" }}</td>
                            <td>{{ $data->tgl_lahir_ibu ? \Carbon\Carbon::parse($data->tgl_lahir_ibu)->format("d-m-Y") : "-" }}
                            </td>
                        </tr>
                    @else
                        @if (isset($data->ayah))
                            <tr>
                                <td>1</td>
                                <td>{{ $data->ayah }}</td>
                                <td>Laki-Laki</td>
                                <td>{{ $data->tempat_lahir_ayah ?? "-" }}</td>
                                <td>{{ $data->tgl_lahir_ayah ? \Carbon\Carbon::parse($data->tgl_lahir_ayah)->format("d-m-Y") : "-" }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>1</td>
                                <td>{{ $data->ibu }}</td>
                                <td>Perempuan</td>
                                <td>{{ $data->tempat_lahir_ibu ?? "-" }}</td>
                                <td>{{ $data->tgl_lahir_ibu ? \Carbon\Carbon::parse($data->tgl_lahir_ibu)->format("d-m-Y") : "-" }}
                                </td>
                            </tr>
                        @endif
                    @endif

                    @if (isset($data->remaja))
                        @foreach ($data->remaja as $r)
                            <tr>
                                <td>{{ $loop->iteration + 2 }}</td>
                                <td>{{ $r->nama }}</td>
                                <td>{{ $r->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan" }}</td>
                                <td>{{ $r->tempat_lahir ?? "-" }}</td>
                                <td>{{ $r->tanggal_lahir ? \Carbon\Carbon::parse($r->tanggal_lahir)->format("d-m-Y") : "-" }}
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    @if (isset($data->sekolahMinggu))
                        @foreach ($data->sekolahMinggu as $sm)
                            <tr>
                                <td>{{ $loop->iteration + (isset($data->remaja) ? count($data->remaja) + 2 : 2) }}</td>
                                <td>{{ $sm->nama }}</td>
                                <td>{{ $sm->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan" }}</td>
                                <td>{{ $sm->tempat_lahir ?? "-" }}</td>
                                <td>{{ $sm->tanggal_lahir ? \Carbon\Carbon::parse($sm->tanggal_lahir)->format("d-m-Y") : "-" }}
                                </td>
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

            <!-- Signature Section -->
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
                <tr>
                    <td width="60%" style="vertical-align: top;">
                        <!-- Area kosong untuk balance -->
                    </td>
                    <td width="40%" style="text-align: center; vertical-align: top;">
                        <div style="margin-bottom: 15px; font-size: 12px; color: #333;">
                            Pimpinan Sidang
                        </div>

                        <div
                            style="margin: 10px 0; height: 50px; display: flex; align-items: center; justify-content: center;">
                            @if (file_exists(public_path("assets/img/ttd-pendeta.png")))
                                <img src="{{ public_path("assets/img/ttd-pendeta.png") }}" alt="Tanda Tangan Pendeta"
                                    style="max-width: 250px; max-height: 100px; margin-top: -25px; object-fit: contain;">
                            @else
                                <!-- Space untuk tanda tangan manual -->
                                <div style="height: 50px; width: 120px; border-bottom: 1px solid #ccc; margin: 10px 0;">
                                </div>
                            @endif
                        </div>

                        <div
                            style="padding-top: 3px; font-size: 11px; font-weight: bold; color: #333; margin-top: 5px;">
                            Pdt. Sarlen Gultom
                        </div>
                        <div style="font-size: 10px; color: #666; margin-top: 1px;">
                            Pimpinan Sidang GPI Perawang
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="footer">GPI Sidang Perawang</div>

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->getFont('DejaVu Sans', 'normal');
            $pdf->page_text(520, 820, "Halaman {PAGE_NUM} / {PAGE_COUNT}", $font, 9, array(0,0,0));
        }
    </script>
</body>

</html>
