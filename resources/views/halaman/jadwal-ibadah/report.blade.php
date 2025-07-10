@extends('komponent.app')

@section('title', 'Report Pendaftar Ibadah')

@section('halaman', 'Report Pendaftar Ibadah')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h5>Filter Report</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('report-pendaftar-ibadah') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tanggal_mulai" class="form-control-label">Tanggal Mulai</label>
                                <input class="form-control" type="date" name="tanggal_mulai" id="tanggal_mulai"
                                       value="{{ request('tanggal_mulai') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tanggal_selesai" class="form-control-label">Tanggal Selesai</label>
                                <input class="form-control" type="date" name="tanggal_selesai" id="tanggal_selesai"
                                       value="{{ request('tanggal_selesai') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jenis_ibadah_id" class="form-control-label">Jenis Ibadah</label>
                                <select class="form-control" name="jenis_ibadah_id" id="jenis_ibadah_id">
                                    <option value="">Semua Jenis Ibadah</option>
                                    @foreach($jenisIbadah as $jenis)
                                        <option value="{{ $jenis->id }}"
                                                {{ request('jenis_ibadah_id') == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->jenis_ibadah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-control-label">&nbsp;</label>
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-search me-1"></i> Filter
                                    </button>
                                    <a href="{{ route('report-pendaftar-ibadah') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-refresh me-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Report Card -->
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4>Report Pendaftar Ibadah</h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('report-pendaftar-ibadah.export', request()->query()) }}"
                       class="btn btn-success btn-sm" target="_blank">
                        <i class="fas fa-download me-1"></i> Export Excel
                    </a>
                    <button onclick="window.print()" class="btn btn-info btn-sm">
                        <i class="fas fa-print me-1"></i> Print
                    </button>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

                <!-- Summary Stats -->
                <div class="row mb-4 px-3">
                    <div class="col-md-3">
                        <div class="card bg-gradient-primary">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-white font-weight-bold">Total Jadwal</p>
                                            <h5 class="font-weight-bolder mb-0 text-white">
                                                {{ $data->count() }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow border-radius-md">
                                            <i class="fas fa-calendar text-primary text-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-success">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-white font-weight-bold">Total Pendaftar</p>
                                            <h5 class="font-weight-bolder mb-0 text-white">
                                                {{ $data->sum(function($jadwal) { return $jadwal->pendaftarIbadah->count(); }) }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow border-radius-md">
                                            <i class="fas fa-users text-success text-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-info">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-white font-weight-bold">Rata-rata per Ibadah</p>
                                            <h5 class="font-weight-bolder mb-0 text-white">
                                                {{ $data->count() > 0 ? round($data->sum(function($jadwal) { return $jadwal->pendaftarIbadah->count(); }) / $data->count(), 1) : 0 }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow border-radius-md">
                                            <i class="fas fa-chart-line text-info text-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-gradient-warning">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-white font-weight-bold">Jenis Ibadah</p>
                                            <h5 class="font-weight-bolder mb-0 text-white">
                                                {{ $data->pluck('jenisIbadah.jenis_ibadah')->unique()->count() }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow border-radius-md">
                                            <i class="fas fa-church text-warning text-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="table-responsive p-0">
                    <table id="datatables" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Ibadah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Pendaftar</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-left text-sm">
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $item->jenisIbadah->jenis_ibadah }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $item->tempat }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">
                                            {{ $item->pendaftarIbadah->count() }} orang
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="fas fa-eye"></i> Lihat
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="alert alert-info mb-0">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Tidak ada data pendaftar ibadah yang ditemukan
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Detail Pendaftar -->
@foreach ($data as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">
                    Detail Pendaftar - {{ $item->jenisIbadah->jenis_ibadah }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Jam:</strong> {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <strong>Tempat:</strong> {{ $item->tempat }}
                        @if($item->alamat)
                            <br><small class="text-muted">{{ $item->alamat }}</small>
                        @endif
                    </div>
                </div>
                <hr>
                <h6>Daftar Pendaftar ({{ $item->pendaftarIbadah->count() }} orang):</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->pendaftarIbadah as $pendaftar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pendaftar->user->name }}</td>
                                    <td>{{ $pendaftar->user->email }}</td>
                                    <td>{{ $pendaftar->user->no_telp ?? '-' }}</td>
                                    <td>{{ $pendaftar->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pendaftar->created_at)->translatedFormat('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
