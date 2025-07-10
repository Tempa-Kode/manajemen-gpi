@extends('komponent.app')

@section('title', 'Detail Data Kolekte')

@section('halaman', 'Detail Data Kolekte')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Detail Data Kolekte</h4>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('kolekte.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="px-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Jadwal Ibadah</h5>
                                    <p class="card-text display-6 text-info">
                                        {{ $kolekte->jadwalIbadah->jenisIbadah->jenis_ibadah ?? 'Tidak ada' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Tanggal Ibadah</h5>
                                    <p class="card-text display-6 text-secondary">
                                        {{ $kolekte->tanggal_ibadah ? $kolekte->tanggal_ibadah->format('d/m/Y') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pembangunan Gereja</h5>
                                    <p class="card-text display-6 text-primary">
                                        Rp {{ number_format($kolekte->pembangunan_gereja, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Persembahan Pelayanan Pengerja</h5>
                                    <p class="card-text display-6 text-success">
                                        Rp {{ number_format($kolekte->persembahan_pelayanan_pengerja, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Persembahan Pelayanan Sosial Gereja</h5>
                                    <p class="card-text display-6 text-warning">
                                        Rp {{ number_format($kolekte->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-gradient-primary">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Total Kolekte</h5>
                                    <p class="card-text display-5 text-white">
                                        <strong>Rp {{ number_format($kolekte->pembangunan_gereja + $kolekte->persembahan_pelayanan_pengerja + $kolekte->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($kolekte->keterangan)
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Keterangan</h5>
                                    <p class="card-text">{{ $kolekte->keterangan }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Informasi Tambahan</h5>
                                    <p class="card-text">
                                        <strong>Tanggal Dibuat:</strong> {{ $kolekte->created_at->format('d/m/Y H:i') }}<br>
                                        <strong>Terakhir Diupdate:</strong> {{ $kolekte->updated_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('kolekte.edit', $kolekte->id) }}" class="btn btn-primary me-2">
                                    <i class="fa-solid fa-pen-to-square me-2"></i>
                                    Edit
                                </a>
                                <form action="{{ route('kolekte.destroy', $kolekte->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
