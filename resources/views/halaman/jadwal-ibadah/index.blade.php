@extends('komponent.app')

@section('title', 'Data Jadwal Ibadah')

@section('halaman', 'Data Jadwal Ibadah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4>Data Jadwal Ibadah</h4>
                <div class="">
                    <a href="{{ route('jadwal-ibadah.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i>
                        Tambah Data
                    </a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success text-white" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="datatables" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis Ibadah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-25">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                <td class="align-middle text-left text-sm">{{ $item->jenisIbadah->jenis_ibadah ?? 'Tidak ada jenis' }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->hari }}</td>
                                <td class="align-middle text-center text-sm">{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->jam }}</td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge bg-info">{{ $item->tempat ?? 'Tidak diisi' }}</span>
                                    @if($item->alamat)
                                        <br><small class="text-muted">{{ Str::limit($item->alamat, 30) }}</small>
                                    @endif
                                </td>
                                <td class="align-middle text-center w-25">
                                    <a href="{{ route('jadwal-ibadah.edit', $item->id) }}" class="btn btn-sm btn-secondary"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('jadwal-ibadah.show', $item->id) }}" class="btn btn-sm btn-info"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <i class="fa-solid fa-eye me-2"></i>
                                    </a>
                                    <form action="{{ route('jadwal-ibadah.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger ms-2">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
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
@endsection
