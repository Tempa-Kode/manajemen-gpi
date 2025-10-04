@extends('komponent.app')

@section('title', 'Data Saran & Masukan')

@section('halaman', 'Data Saran & Masukan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4>Data Saran & Masukan</h4>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subjek</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Kirim</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Pesan
                                </th>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                <td class="align-middle text-left text-sm">{{ $item->nama }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->email }}</td>
                                <td class="align-middle text-center text-sm">{{ $item->subjek }}</td>
                                <td class="align-middle text-center text-sm">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM Y') }}</td>
                                <td class="align-middle text-center text-sm">
                                    <button class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Detail" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                        <i class="fa-solid fa-comments me-2"></i> Detail
                                    </button>
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

{{-- Modal Detail Pesan --}}
    @foreach ($data as $item)
    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama:</strong> {{ $item->nama }}</p>
                            <p><strong>Email:</strong> {{ $item->email }}</p>
                            <p><strong>Subjek:</strong> {{ $item->subjek }}</p>
                            <p><strong>Tanggal Kirim:</strong> {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM Y') }}</p>
                        </div>
                        <div class="col-md-12">
                            <p><strong>Pesan:</strong></p>
                            <p>{{ $item->pesan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
