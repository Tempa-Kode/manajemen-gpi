@extends('komponent.app')

@section('title', 'Data Jemaat')

@section('halaman', 'Data Jemaat')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4>Data Jemaat</h4>
                <div class="">
                    <a href="{{ route('data-jemaat.create') }}" class="btn btn-primary">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID KK</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Keluarga</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Hp</th>
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
@endsection
