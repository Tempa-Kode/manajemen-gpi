@extends('komponent.app')

@section('title', 'Edit Jenis Ibadah - Manajemen GPI')

@section('halaman', 'Edit Jenis Ibadah')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Form Edit Jenis Ibadah</h6>
                        <a href="{{ route('jenis-ibadah.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('jenis-ibadah.update', $jenisIbadah->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="jenis_ibadah" class="form-control-label">Jenis Ibadah <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control @error('jenis_ibadah') is-invalid @enderror"
                                               id="jenis_ibadah"
                                               name="jenis_ibadah"
                                               value="{{ old('jenis_ibadah', $jenisIbadah->jenis_ibadah) }}"
                                               placeholder="Contoh: Kebaktian Umum, Doa Syafaat, Ibadah Anak"
                                               required>
                                        @error('jenis_ibadah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Masukkan nama jenis ibadah (maksimal 100 karakter)
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('jenis-ibadah.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
