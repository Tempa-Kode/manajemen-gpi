@extends('komponent.app')

@section('title', 'Edit Data Sekolah Minggu')

@section('halaman', 'Edit Data Sekolah Minggu')

@section('content')
<div class="container-fluid py-4">
    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 text-primary">
                                <i class="fas fa-edit me-2"></i>
                                Edit Data Anak Sekolah Minggu
                            </h3>
                            <p class="text-muted mb-0">Perbarui informasi anak sekolah minggu</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('data-jemaat.show', $sekolahMinggu->jemaat->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <a href="{{ route('sekolah-minggu.show', $sekolahMinggu) }}" class="btn btn-outline-info">
                                <i class="fas fa-eye me-2"></i>Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white p-4">
                    <h5 class="mb-0 text-white">
                        <i class="fas fa-form me-2"></i>
                        Form Edit Data Anak
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('sekolah-minggu.update', $sekolahMinggu) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Pilih Keluarga -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="id_kk" class="form-label text-dark fw-bold">
                                        <i class="fas fa-users text-primary me-2"></i>Keluarga
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('id_kk') is-invalid @enderror"
                                            id="id_kk" name="id_kk" required>
                                        <option value="">Pilih Keluarga</option>
                                        @foreach($jemaat as $kel)
                                            <option value="{{ $kel->id }}"
                                                    {{ old('id_kk', $sekolahMinggu->id_kk) == $kel->id ? 'selected' : '' }}>
                                                {{ $kel->nama_keluarga }} (ID KK: {{ $kel->id_kk }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_kk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Anak -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label text-dark fw-bold">
                                        <i class="fas fa-child text-primary me-2"></i>Nama Anak
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" name="nama"
                                           value="{{ old('nama', $sekolahMinggu->nama) }}"
                                           placeholder="Masukkan nama anak" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="form-label text-dark fw-bold">
                                        <i class="fas fa-calendar text-primary me-2"></i>Tanggal Lahir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date"
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                           id="tanggal_lahir" name="tanggal_lahir"
                                           value="{{ old('tanggal_lahir', $sekolahMinggu->tanggal_lahir ? $sekolahMinggu->tanggal_lahir->format('Y-m-d') : '') }}"
                                           required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label text-dark fw-bold">
                                        <i class="fas fa-venus-mars text-primary me-2"></i>Jenis Kelamin
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                                   type="radio" name="jenis_kelamin" id="laki" value="L"
                                                   {{ old('jenis_kelamin', $sekolahMinggu->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="laki">
                                                <i class="fas fa-mars text-primary me-1"></i>Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                                   type="radio" name="jenis_kelamin" id="perempuan" value="P"
                                                   {{ old('jenis_kelamin', $sekolahMinggu->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="perempuan">
                                                <i class="fas fa-venus text-primary me-1"></i>Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kelas -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelas" class="form-label text-dark fw-bold">
                                        <i class="fas fa-chalkboard text-primary me-2"></i>Kelas
                                    </label>
                                    <input type="text"
                                           class="form-control @error('kelas') is-invalid @enderror"
                                           id="kelas" name="kelas"
                                           value="{{ old('kelas', $sekolahMinggu->kelas) }}"
                                           placeholder="Contoh: Kelas 1, Balita, dll">
                                    @error('kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status" class="form-label text-dark fw-bold">
                                        <i class="fas fa-toggle-on text-primary me-2"></i>Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('status') is-invalid @enderror"
                                            id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="aktif" {{ old('status', $sekolahMinggu->status) == 'aktif' ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="tidak_aktif" {{ old('status', $sekolahMinggu->status) == 'tidak_aktif' ? 'selected' : '' }}>
                                            Tidak Aktif
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('sekolah-minggu.show', $sekolahMinggu) }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-info text-white p-3">
                    <h6 class="mb-0 text-white">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Data
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <small class="text-muted">Nama Anak</small>
                        <div class="fw-bold">{{ $sekolahMinggu->nama }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Keluarga</small>
                        <div class="fw-bold">{{ $sekolahMinggu->jemaat->nama_keluarga }}</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Umur Saat Ini</small>
                        <div class="fw-bold">{{ $sekolahMinggu->umur }} tahun</div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Data Dibuat</small>
                        <div class="fw-bold">{{ $sekolahMinggu->created_at->format('d F Y') }}</div>
                    </div>
                    <div>
                        <small class="text-muted">Terakhir Diupdate</small>
                        <div class="fw-bold">{{ $sekolahMinggu->updated_at->format('d F Y, H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-gradient-warning text-white p-3">
                    <h6 class="mb-0 text-white">
                        <i class="fas fa-question-circle me-2"></i>
                        Petunjuk
                    </h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Field dengan tanda (*) wajib diisi</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Pastikan data keluarga sudah benar</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Tanggal lahir akan otomatis menghitung umur</small>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success me-2"></i>
                            <small>Status aktif untuk anak yang masih mengikuti sekolah minggu</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #0d6efd, #6610f2);
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

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
@endsection
