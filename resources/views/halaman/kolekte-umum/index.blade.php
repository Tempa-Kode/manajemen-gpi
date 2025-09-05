@extends('komponent.app')

@section('halaman', 'Kolekte Umum')

@section('title', 'Data Kolekte Umum - Manajemen GPI')

@section('halaman', 'Data Kolekte Umum')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Minggu Ini</h5>
                        <p class="card-text">Rp {{ number_format($totalMingguIni, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Bulan Ini</h5>
                        <p class="card-text">Rp {{ number_format($totalBulanIni, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Tahun Ini</h5>
                        <p class="card-text">Rp {{ number_format($totalTahunIni, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card my-4 px-3">
            <div class="card-header pb-0">
               <div class="d-flex justify-content-between">
                   <h4>Data Kolekte Umum</h4>
                   <a href="{{ route('kolekte-umum.create') }}" class="btn btn-primary">Tambah Data</a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ibadah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nominal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Ibadah</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                <td class="align-middle text-left text-sm">{{ $item->jadwalIbadah->jenisIbadah->jenis_ibadah ?? 'Tidak ada' }}</td>
                                <td class="align-middle text-center text-sm">Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->jadwalIbadah->tanggal->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                                <td class="align-middle text-center w-25">
                                    <a href="{{ route('kolekte-umum.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('kolekte-umum.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
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
