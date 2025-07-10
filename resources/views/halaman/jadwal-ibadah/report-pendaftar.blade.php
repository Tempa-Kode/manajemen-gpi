@extends('komponent.app')

@section('title', 'Report Pendaftar Ibadah')

@section('halaman', 'Report Pendaftar Ibadah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6>Filter Report Pendaftar Ibadah</h6>
                    </div>
                </div>
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
                                <select name="jenis_ibadah_id" id="jenis_ibadah_id" class="form-control">
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
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                    <a href="{{ route('report-pendaftar-ibadah') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-refresh"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h6>Rekap Pendaftar Ibadah</h6>
                        <p class="text-sm mb-0">
                            Total {{ $data->count() }} jadwal ibadah dengan {{ $data->sum(function($jadwal) { return $jadwal->pendaftarIbadah->count(); }) }} pendaftar
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        @if($data->count() > 0)
                            <a href="{{ route('report-pendaftar-ibadah.pdf', request()->query()) }}"
                               class="btn btn-danger btn-sm" target="_blank">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Ibadah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Pendaftar</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-left text-sm">
                                        <span class="badge badge-sm bg-gradient-primary">
                                            {{ $item->jenisIbadah->jenis_ibadah ?? 'Tidak ada jenis' }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        {{ \Carbon\Carbon::parse($item->jam)->format('H:i') }} WIB
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">
                                            {{ $item->pendaftarIbadah->count() }} orang
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn btn-link text-dark p-0 mb-0"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#detail-{{ $item->id }}"
                                                aria-expanded="false">
                                            <i class="fas fa-eye text-secondary"></i> Lihat Detail
                                        </button>
                                    </td>
                                </tr>
                                @if($item->pendaftarIbadah->count() > 0)
                                    <tr class="collapse" id="detail-{{ $item->id }}">
                                        <td colspan="6" class="px-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="mb-0">Daftar Pendaftar</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama</th>
                                                                    <th>Username</th>
                                                                    <th>No Telp</th>
                                                                    <th>Jenis Kelamin</th>
                                                                    <th>Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($item->pendaftarIbadah as $pendaftar)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $pendaftar->user->name }}</td>
                                                                        <td>{{ $pendaftar->user->username }}</td>
                                                                        <td>{{ $pendaftar->user->no_telp ?? '-' }}</td>
                                                                        <td>
                                                                            @if($pendaftar->user->jenis_kelamin == 'L')
                                                                                <span class="badge bg-primary">Laki-laki</span>
                                                                            @else
                                                                                <span class="badge bg-info">Perempuan</span>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $pendaftar->keterangan ?? '-' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                            <p>Tidak ada data jadwal ibadah dengan filter yang dipilih</p>
                                            <small>Silakan ubah filter atau tambah jadwal ibadah baru</small>
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
@endsection

@section('scripts')
<script>
    // Auto submit form when date or select changes
    document.getElementById('tanggal_mulai').addEventListener('change', function() {
        // Optional: auto submit on change
        // this.form.submit();
    });

    document.getElementById('tanggal_selesai').addEventListener('change', function() {
        // Optional: auto submit on change
        // this.form.submit();
    });

    document.getElementById('jenis_ibadah_id').addEventListener('change', function() {
        // Optional: auto submit on change
        // this.form.submit();
    });
</script>
@endsection
