@extends('komponent.app')

@section('halaman', 'Permohonan Surat')

@section('title', 'Data Permohonan Surat - Manajemen GPI')

@section('halaman', 'Data Permohonan Surat')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Data Permohonan Surat</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive px-3">
                            <table class="table align-items-center mb-0" id="datatables">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Surat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pemohon</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telp</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->templateSurat->nama_template }}</td>
                                        <td>{{ $item->nama_pemohon }}</td>
                                        <td>{{ $item->no_telp }}</td>
                                        <td class="text-capitalize">{{ $item->status }}</td>
                                        <td>
                                            @if($item->status == 'pending')
                                                <a href="{{ route('permohonan-surat.edit', $item->suratTerbit->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                                <form action="{{ route('permohonan-surat.tolak', $item->id) }}" method="post" style="display:inline-block;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                                </form>
                                            @else
                                                -
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
    </div>
@endsection
