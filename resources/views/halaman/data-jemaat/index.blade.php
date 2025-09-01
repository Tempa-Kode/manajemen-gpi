@extends('komponent.app')

@section('title', 'Data Keluarga Jemaat')

@section('halaman', 'Data Keluarga Jemaat')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4>Data Jemaat</h4>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('data-jemaat.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-2"></i>
                        Tambah Data
                    </a>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-file-arrow-down me-2"></i> Download Laporan
                    </button>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID KK</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Keluarga</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Hp</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Pendaftaran</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-25">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                <td class="align-middle text-left text-sm">{{ $item->id_kk }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->nama_keluarga }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->no_hp }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->tgl_keluar ? 'Keluar' : 'Aktif' }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->tanggal_pendaftaran ?? '-' }}</td>
                                <td class="align-middle text-center w-25">
                                    <a href="{{ route('data-jemaat.edit', $item->id) }}" class="btn btn-sm btn-secondary"
                                        data-toggle="tooltip" data-original-title="data jemaat">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('data-jemaat.show', $item->id) }}" class="btn btn-sm btn-info"
                                        data-toggle="tooltip" data-original-title="data jemaat">
                                        <i class="fa-solid fa-eye me-2"></i>
                                    </a>
                                    <form action="{{ route('data-jemaat.destroy', $item->id) }}" method="POST" class="d-inline">
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

{{-- Modal Download Report --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('data-jemaat.laporan') }}" method="get">
                @method('GET')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Laporan Data Jemaat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select" aria-label="Default select example" name="data">
                        <option hidden value="">pilih data</option>
                        <option value="jemaat">Seluruh Jemaat</option>
                        <option value="remaja">Remaja</option>
                        <option value="anak_sekolah_minggu">Anak Sekolah Minggu</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Download</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
