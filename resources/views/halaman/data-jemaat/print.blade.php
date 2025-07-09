<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Keluarga {{ $data->nama_keluarga }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-before: always;
            }
            body {
                margin: 0;
                padding: 20px;
                background: white !important;
            }
            .card {
                box-shadow: none !important;
                border: 1px solid #dee2e6 !important;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .print-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #0d6efd;
        }

        .print-title {
            color: #0d6efd;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .data-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .data-table th {
            background-color: #f8f9fa;
            width: 200px;
            font-weight: 600;
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        .data-table td {
            padding: 12px;
            border: 1px solid #dee2e6;
        }

        .section-title {
            background-color: #0d6efd;
            color: white;
            padding: 10px 15px;
            margin: 25px 0 15px 0;
            border-radius: 5px;
            font-weight: 600;
        }

        .member-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: white;
        }

        .member-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .member-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-weight: bold;
        }

        .member-name {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .member-info {
            font-size: 14px;
            color: #6c757d;
            margin: 0;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-aktif {
            background-color: #d1edff;
            color: #0d6efd;
        }

        .status-tidak-aktif {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        .footer-info {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Print Header -->
        <div class="print-header">
            <h2 class="print-title">
                <i class="fas fa-users me-2"></i>
                DATA KELUARGA GEREJA
            </h2>
            <h4 class="text-muted">{{ $data->nama_keluarga }}</h4>
            <p class="mb-0">ID Kartu Keluarga: {{ $data->id_kk }}</p>
        </div>

        <!-- Print Button -->
        <div class="no-print mb-3">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Cetak Dokumen
            </button>
            <a href="{{ route('data-jemaat.show', $data->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <!-- Data Keluarga -->
        <div class="row">
            <div class="col-12">
                <h5 class="section-title">
                    <i class="fas fa-home me-2"></i>
                    INFORMASI KELUARGA
                </h5>

                <table class="data-table">
                    <tr>
                        <th><i class="fas fa-id-card me-2"></i>ID Kartu Keluarga</th>
                        <td>{{ $data->id_kk }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-users me-2"></i>Nama Keluarga</th>
                        <td>{{ $data->nama_keluarga }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-male me-2"></i>Nama Ayah</th>
                        <td>{{ $data->ayah ?? 'Belum diisi' }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-female me-2"></i>Nama Ibu</th>
                        <td>{{ $data->ibu ?? 'Belum diisi' }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-map-marker-alt me-2"></i>Alamat</th>
                        <td>{{ $data->alamat }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-phone me-2"></i>Nomor Telepon</th>
                        <td>{{ $data->no_hp ?? 'Belum diisi' }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-calendar me-2"></i>Tanggal Terdaftar</th>
                        <td>{{ $data->created_at->format('d F Y, H:i') }} WIB</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Statistik Keluarga -->
        <div class="row">
            <div class="col-12">
                <h5 class="section-title">
                    <i class="fas fa-chart-pie me-2"></i>
                    STATISTIK ANGGOTA KELUARGA
                </h5>

                <div class="row text-center">
                    <div class="col-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body py-3">
                                <h3 class="mb-1">{{ $data->sekolahMinggu->count() }}</h3>
                                <p class="mb-0 small">Anak Sekolah Minggu</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-success text-white">
                            <div class="card-body py-3">
                                <h3 class="mb-1">{{ $data->remaja->count() }}</h3>
                                <p class="mb-0 small">Remaja</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bg-info text-white">
                            <div class="card-body py-3">
                                <h3 class="mb-1">{{ $data->totalAnggota }}</h3>
                                <p class="mb-0 small">Total Anggota</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Anak Sekolah Minggu -->
        @if($data->sekolahMinggu->count() > 0)
            <div class="row">
                <div class="col-12">
                    <h5 class="section-title">
                        <i class="fas fa-book-open me-2"></i>
                        ANAK SEKOLAH MINGGU ({{ $data->sekolahMinggu->count() }} orang)
                    </h5>

                    @foreach($data->sekolahMinggu as $index => $sm)
                        <div class="member-card">
                            <div class="member-header">
                                <div class="member-avatar bg-primary">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h6 class="member-name">{{ $sm->nama }}</h6>
                                    <p class="member-info">
                                        {{ $sm->jenisKelaminText }} • {{ $sm->umur }} tahun •
                                        Lahir: {{ $sm->tanggal_lahir->format('d F Y') }}
                                    </p>
                                </div>
                                <div class="ms-auto">
                                    <span class="status-badge status-{{ $sm->status }}">
                                        {{ $sm->statusText }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Kelas:</strong> {{ $sm->kelas ?? 'Belum ditentukan' }}
                                </div>
                                <div class="col-6">
                                    <strong>Terdaftar:</strong> {{ $sm->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Data Remaja -->
        @if($data->remaja->count() > 0)
            <div class="row">
                <div class="col-12">
                    <h5 class="section-title">
                        <i class="fas fa-user-graduate me-2"></i>
                        REMAJA ({{ $data->remaja->count() }} orang)
                    </h5>

                    @foreach($data->remaja as $index => $remaja)
                        <div class="member-card">
                            <div class="member-header">
                                <div class="member-avatar bg-success">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h6 class="member-name">{{ $remaja->nama }}</h6>
                                    <p class="member-info">
                                        {{ $remaja->jenisKelaminText }} • {{ $remaja->umur }} tahun •
                                        Lahir: {{ $remaja->tanggal_lahir->format('d F Y') }}
                                    </p>
                                </div>
                                <div class="ms-auto">
                                    <span class="status-badge status-{{ $remaja->status }}">
                                        {{ $remaja->statusText }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <strong>Pendidikan:</strong> {{ $remaja->pendidikan ?? 'Belum diisi' }}
                                </div>
                                <div class="col-4">
                                    <strong>Pekerjaan:</strong> {{ $remaja->pekerjaan ?? 'Belum diisi' }}
                                </div>
                                <div class="col-4">
                                    <strong>Terdaftar:</strong> {{ $remaja->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Footer Info -->
        <div class="footer-info">
            <div class="row">
                <div class="col-6">
                    <p class="mb-0"><strong>Dokumen dicetak pada:</strong> {{ now()->format('d F Y, H:i') }} WIB</p>
                </div>
                <div class="col-6 text-end">
                    <p class="mb-0"><strong>Sistem Manajemen Gereja</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto print ketika halaman dimuat (opsional)
        // window.addEventListener('load', function() {
        //     setTimeout(function() {
        //         window.print();
        //     }, 500);
        // });

        // Kembali ke halaman sebelumnya setelah print
        window.addEventListener('afterprint', function() {
            // window.history.back();
        });
    </script>
</body>
</html>
