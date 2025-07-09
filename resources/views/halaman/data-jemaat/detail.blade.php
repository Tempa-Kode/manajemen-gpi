@extends('komponent.app')

@section('title', 'Detail Data Jemaat')

@section('halaman', 'Detail Data Jemaat')

@section('content')
<div class="container-fluid py-4">
    <!-- Alert Success -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header with Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 text-primary">
                                <i class="fas fa-users me-2"></i>
                                Detail Keluarga {{ $data->nama_keluarga }}
                            </h3>
                            <p class="text-muted mb-0">ID KK: {{ $data->id_kk }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('data-jemaat.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <a href="{{ route('data-jemaat.edit', $data->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-edit me-2"></i>Edit Data
                            </a>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Family Data -->
        <div class="col-12 col-xl-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-primary text-white p-4">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-home me-2"></i>
                        Informasi Keluarga
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- ID KK -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark fw-bold">
                                    <i class="fas fa-id-card text-primary me-2"></i>ID Kartu Keluarga
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-hashtag text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 bg-light" readonly value="{{ $data->id_kk }}">
                                </div>
                            </div>
                        </div>

                        <!-- Nama Keluarga -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark fw-bold">
                                    <i class="fas fa-users text-primary me-2"></i>Nama Keluarga
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-font text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 bg-light" readonly value="{{ $data->nama_keluarga }}">
                                </div>
                            </div>
                        </div>

                        <!-- Nama Ayah -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark fw-bold">
                                    <i class="fas fa-male text-primary me-2"></i>Nama Ayah
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 bg-light" readonly
                                           value="{{ $data->ayah ?? 'Belum diisi' }}"
                                           style="{{ empty($data->ayah) ? 'font-style: italic; color: #6c757d;' : '' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Nama Ibu -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark fw-bold">
                                    <i class="fas fa-female text-primary me-2"></i>Nama Ibu
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 bg-light" readonly
                                           value="{{ $data->ibu ?? 'Belum diisi' }}"
                                           style="{{ empty($data->ibu) ? 'font-style: italic; color: #6c757d;' : '' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label text-dark fw-bold">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>Alamat Lengkap
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-home text-muted"></i>
                                    </span>
                                    <textarea class="form-control border-start-0 bg-light" readonly rows="3">{{ $data->alamat }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- No HP -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark fw-bold">
                                    <i class="fas fa-phone text-primary me-2"></i>Nomor Telepon
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-mobile-alt text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 bg-light" readonly
                                           value="{{ $data->no_hp ?? 'Belum diisi' }}"
                                           style="{{ empty($data->no_hp) ? 'font-style: italic; color: #6c757d;' : '' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Terdaftar -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label text-dark fw-bold">
                                    <i class="fas fa-calendar text-primary me-2"></i>Tanggal Terdaftar
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-clock text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 bg-light" readonly
                                           value="{{ $data->created_at->format('d F Y, H:i') }} WIB">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar with Statistics -->
        <div class="col-12 col-xl-4 mb-4">
            <div class="row g-4">
                <!-- Family Statistics -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-gradient-info text-white p-3">
                            <h6 class="mb-0 text-white">
                                <i class="fas fa-chart-pie me-2"></i>
                                Statistik Keluarga
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">
                                    <i class="fas fa-child me-2"></i>Anak Sekolah Minggu
                                </span>
                                <span class="badge bg-primary rounded-pill">{{ $data->sekolahMinggu->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">
                                    <i class="fas fa-user-graduate me-2"></i>Remaja
                                </span>
                                <span class="badge bg-success rounded-pill">{{ $data->remaja->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-users me-2"></i>Total Anggota
                                </span>
                                <span class="badge bg-info rounded-pill">{{ $data->totalAnggota }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-gradient-warning text-white p-3">
                            <h6 class="mb-0 text-white">
                                <i class="fas fa-bolt me-2"></i>
                                Aksi Cepat
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-grid gap-2">
                                <a href="{{ route('sekolah-minggu.create') }}?keluarga={{ $data->id }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-plus me-2"></i>Tambah Anak SM
                                </a>
                                <a href="{{ route('remaja.create') }}?keluarga={{ $data->id }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-plus me-2"></i>Tambah Remaja
                                </a>
                                <a href="{{ route('data-jemaat.print', $data->id) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-print me-2"></i>Cetak Data
                                </a>
                                <button onclick="printData()" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-file-pdf me-2"></i>Print Langsung
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Children Data Sections -->
    <div class="row">
        <!-- Sekolah Minggu Section -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-primary text-white p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0 text-white">
                            <i class="fas fa-book-open me-2"></i>
                            Data Anak Sekolah Minggu
                        </h6>
                    </div>
                </div>
                <div class="card-body p-3">
                    @if($data->sekolahMinggu->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($data->sekolahMinggu as $sm)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-primary rounded-circle me-3">
                                            @if($sm->jenis_kelamin == 'L')
                                                <i class="fas fa-mars text-white"></i>
                                            @else
                                                <i class="fas fa-venus text-white"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0"><a href="{{ route('sekolah-minggu.show', $sm->id) }}">{{ $sm->nama }}</a></h6>
                                            <small class="text-muted">{{ $sm->umur }} tahun | {{ $sm->kelas ?? 'Belum ada kelas' }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ route('sekolah-minggu.show', $sm->id) }}" class="badge bg-primary">
                                        Detail
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('sekolah-minggu.create') }}?keluarga={{ $data->id }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-plus me-2"></i>Tambah Anak SM
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-child text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">Belum ada data anak sekolah minggu</p>
                            <a href="{{ route('sekolah-minggu.create') }}?keluarga={{ $data->id }}" class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-plus me-2"></i>Tambah Data
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Remaja Section -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-success text-white p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0 text-white">
                            <i class="fas fa-user-graduate me-2"></i>
                            Data Remaja
                        </h6>
                    </div>
                </div>
                <div class="card-body p-3">
                    @if($data->remaja->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($data->remaja as $remaja)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-success rounded-circle me-3">
                                            @if($remaja->jenis_kelamin == 'L')
                                                <i class="fas fa-mars text-white"></i>
                                            @else
                                                <i class="fas fa-venus text-white"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <h6 class="mb-0"><a href="{{ route('remaja.show', $remaja->id) }}">{{ $remaja->nama }}</a></h6>
                                            <small class="text-muted">{{ $remaja->umur }} tahun | {{ $remaja->pendidikan ?? 'Belum diisi' }}</small>
                                        </div>
                                    </div>
                                    <a href="{{ route('remaja.show', $remaja->id) }}" class="badge bg-success">
                                        Detail
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('remaja.create') }}?keluarga={{ $data->id }}" class="btn btn-success btn-sm w-100">
                                <i class="fas fa-plus me-2"></i>Tambah Remaja
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-graduate text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">Belum ada data remaja</p>
                            <a href="{{ route('remaja.create') }}?keluarga={{ $data->id }}" class="btn btn-success btn-sm mt-2">
                                <i class="fas fa-plus me-2"></i>Tambah Data
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #0d6efd, #6610f2);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #198754, #20c997);
}

.bg-gradient-info {
    background: linear-gradient(45deg, #0dcaf0, #6f42c1);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #ffc107, #fd7e14);
}

.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.input-group-text {
    border-color: #dee2e6;
}

.form-control:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.badge {
    font-size: 0.75rem;
}

.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
}

.avatar {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.list-group-item {
    border: none;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.list-group-item:last-child {
    border-bottom: none;
}
</style>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data keluarga <strong>{{ $data->nama_keluarga }}</strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-warning me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini akan menghapus semua data terkait termasuk data anak sekolah minggu dan remaja.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('data-jemaat.destroy', $data->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript untuk print
    function printData() {
        // Buka halaman print di window baru
        const printWindow = window.open('{{ route("data-jemaat.print", $data->id) }}', '_blank');

        // Tunggu halaman load, lalu print
        printWindow.onload = function() {
            setTimeout(function() {
                printWindow.print();
                printWindow.close();
            }, 500);
        };
    }
</script>
@endsection
