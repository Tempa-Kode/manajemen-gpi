@extends('komponent.app')

@section('title', 'Tambah Data Remaja')

@section('halaman', 'Tambah Data Remaja')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-success text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Data Remaja
                        </h4>
                        <a href="{{ route('data-jemaat.show', request('keluarga')) }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mx-4 mt-3" role="alert">
                        <strong>Error!</strong> Terdapat kesalahan pada input:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mx-4 mt-3" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                    </div>
                @endif

                <div class="card-body p-4">
                    <form action="{{ route('remaja.store') }}" method="POST">
                        @csrf

                        <div class="row g-4">
                            <!-- Pilih Keluarga -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_kk" class="form-label fw-bold">
                                        <i class="fas fa-users text-success me-2"></i>Pilih Keluarga
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-home"></i>
                                        </span>
                                        <select class="form-control" name="id_kk" id="id_kk" required>
                                            <option value="">-- Pilih Keluarga --</option>
                                            @foreach($jemaat as $keluarga)
                                                <option value="{{ $keluarga->id }}"
                                                    {{ old('id_kk', request('keluarga')) == $keluarga->id ? 'selected' : '' }}>
                                                    {{ $keluarga->nama_keluarga }} ({{ $keluarga->id_kk }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_kk')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Remaja -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label fw-bold">
                                        <i class="fas fa-user-graduate text-success me-2"></i>Nama Remaja
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input class="form-control" type="text" name="nama" id="nama"
                                               value="{{ old('nama') }}" required>
                                    </div>
                                    @error('nama')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label fw-bold">
                                        <i class="fas fa-venus-mars text-success me-2"></i>Jenis Kelamin
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-friends"></i>
                                        </span>
                                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    @error('jenis_kelamin')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pendidikan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pendidikan" class="form-label fw-bold">
                                        <i class="fas fa-graduation-cap text-success me-2"></i>Pendidikan <small class="text-muted">(Opsional)</small>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-school"></i>
                                        </span>
                                        <input class="form-control" type="text" name="pendidikan" id="pendidikan"
                                               value="{{ old('pendidikan') }}" placeholder="Contoh: SMA, Kuliah, dll">
                                    </div>
                                    @error('pendidikan')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pekerjaan -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pekerjaan" class="form-label fw-bold">
                                        <i class="fas fa-briefcase text-success me-2"></i>Pekerjaan <small class="text-muted">(Opsional)</small>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-work"></i>
                                        </span>
                                        <input class="form-control" type="text" name="pekerjaan" id="pekerjaan"
                                               value="{{ old('pekerjaan') }}" placeholder="Contoh: Mahasiswa, Karyawan, dll">
                                    </div>
                                    @error('pekerjaan')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i>
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(45deg, #198754, #20c997);
}

.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.form-control:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection
