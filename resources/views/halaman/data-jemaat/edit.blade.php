@extends('komponent.app')

@section('title', 'Edit Data Jemaat')

@section('halaman', 'Edit Data Jemaat')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Edit Data Jemaat
                        </h4>
                        <a href="{{ route('data-jemaat.show', $data->id) }}" class="btn btn-light">
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
                    <form action="{{ route('data-jemaat.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- ID KK -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_kk" class="form-label fw-bold">
                                        <i class="fas fa-id-card text-primary me-2"></i>ID Kartu Keluarga
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-hashtag"></i>
                                        </span>
                                        <input class="form-control" type="number" name="id_kk" id="id_kk"
                                               value="{{ old('id_kk', $data->id_kk) }}" required>
                                    </div>
                                    @error('id_kk')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Keluarga -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_keluarga" class="form-label fw-bold">
                                        <i class="fas fa-users text-primary me-2"></i>Nama Keluarga
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-font"></i>
                                        </span>
                                        <input class="form-control" type="text" name="nama_keluarga" id="nama_keluarga"
                                               value="{{ old('nama_keluarga', $data->nama_keluarga) }}" required>
                                    </div>
                                    @error('nama_keluarga')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Ayah -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ayah" class="form-label fw-bold">
                                        <i class="fas fa-male text-primary me-2"></i>Nama Ayah
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input class="form-control" type="text" name="ayah" id="ayah"
                                               value="{{ old('ayah', $data->ayah) }}">
                                    </div>
                                    @error('ayah')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nama Ibu -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ibu" class="form-label fw-bold">
                                        <i class="fas fa-female text-primary me-2"></i>Nama Ibu
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input class="form-control" type="text" name="ibu" id="ibu"
                                               value="{{ old('ibu', $data->ibu) }}">
                                    </div>
                                    @error('ibu')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alamat" class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>Alamat Lengkap
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-home"></i>
                                        </span>
                                        <textarea class="form-control" name="alamat" id="alamat" rows="3" required>{{ old('alamat', $data->alamat) }}</textarea>
                                    </div>
                                    @error('alamat')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- No HP -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp" class="form-label fw-bold">
                                        <i class="fas fa-phone text-primary me-2"></i>Nomor Telepon
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                        <input class="form-control" type="text" name="no_hp" id="no_hp"
                                               value="{{ old('no_hp', $data->no_hp) }}">
                                    </div>
                                    @error('no_hp')
                                        <span class="text-danger fst-italic">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('data-jemaat.show', $data->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #0d6efd, #6610f2);
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
