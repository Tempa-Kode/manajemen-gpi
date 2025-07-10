@extends('komponent.app')

@section('title', 'Detail Jenis Ibadah - Manajemen GPI')

@section('halaman', 'Detail Jenis Ibadah')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Detail Jenis Ibadah: {{ $jenisIbadah->jenis_ibadah }}</h6>
                        <div>
                            <a href="{{ route('jenis-ibadah.edit', $jenisIbadah->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('jenis-ibadah.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <h6 class="text-uppercase text-sm">Informasi Jenis Ibadah</h6>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="text-sm font-weight-bold">Nama Jenis Ibadah:</td>
                                            <td class="text-sm">{{ $jenisIbadah->jenis_ibadah }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm font-weight-bold">Jumlah Jadwal:</td>
                                            <td class="text-sm">
                                                <span class="badge bg-success">{{ $jenisIbadah->jadwalIbadah->count() }} Jadwal</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm font-weight-bold">Tanggal Dibuat:</td>
                                            <td class="text-sm">{{ $jenisIbadah->created_at->format('d F Y, H:i') }} WIB</td>
                                        </tr>
                                        <tr>
                                            <td class="text-sm font-weight-bold">Terakhir Diperbarui:</td>
                                            <td class="text-sm">{{ $jenisIbadah->updated_at->format('d F Y, H:i') }} WIB</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($jenisIbadah->jadwalIbadah->count() > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Jadwal Ibadah dengan Jenis "{{ $jenisIbadah->jenis_ibadah }}"</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat</th>
                                            <th class="text-secondary opacity-7">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jenisIbadah->jadwalIbadah as $index => $jadwal)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $jadwal->hari }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $jadwal->tanggal->format('d/m/Y') }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $jadwal->jam }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $jadwal->tempat ?? '-' }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('jadwal-ibadah.show', $jadwal->id) }}"
                                                       class="btn btn-info btn-sm" title="Detail Jadwal">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
