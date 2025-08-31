@extends('komponent.app')

@section('title', 'Data Ucapan Syukur')

@section('halaman', 'Data Ucapan Syukur')

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
                <h4>Data Ucapan Syukur</h4>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Jemaat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nominal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                <td class="align-middle text-left text-sm">{{ $item->nama }}</td>
                                <td class="align-middle text-center text-sm">Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->created_at->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                                <td class="align-middle text-center text-sm text-capitalize">{{ $item->status }}</td>
                                <td class="align-middle text-center w-25">
                                    <a href="{{ asset($item->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-outline-success">Bukti Transfer</a>
                                    @if ($item->status == 'pending')
                                        <form action="{{ route('ucapan-syukur.terima', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa-regular fa-circle-check"></i></button>
                                        </form>
                                        <form action="{{ route('ucapan-syukur.tolak', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-regular fa-circle-xmark"></i></button>
                                        </form>
                                    @endif
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
