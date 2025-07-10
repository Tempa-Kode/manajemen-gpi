@extends('komponent.app')

@section('title', 'Data Kolekte')

@section('halaman', 'Data Kolekte')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4>Data Kolekte</h4>
                <div class="">
                    <a href="{{ route('kolekte.create') }}" class="btn btn-primary">
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Ibadah</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembangunan Gereja</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelayanan Pengerja</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelayanan Sosial</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kolektes as $item)
                            <tr>
                                <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                <td class="align-middle text-left text-sm">{{ $item->tanggal_ibadah ? $item->tanggal_ibadah->format('d/m/Y') : '-' }}</td>
                                <td class="align-middle text-left text-sm">Rp {{ number_format($item->pembangunan_gereja, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">Rp {{ number_format($item->persembahan_pelayanan_pengerja, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">Rp {{ number_format($item->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">
                                    <strong>Rp {{ number_format($item->pembangunan_gereja + $item->persembahan_pelayanan_pengerja + $item->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}</strong>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('kolekte.show', $item->id) }}" class="btn btn-sm btn-info me-1"
                                        data-toggle="tooltip" data-original-title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kolekte.edit', $item->id) }}" class="btn btn-sm btn-secondary me-1"
                                        data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('kolekte.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $kolektes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
