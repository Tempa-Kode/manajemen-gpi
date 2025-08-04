@extends('komponent.app')

@section('title', 'Surat Terbit')
@section('halaman', 'Surat Terbit')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Daftar Surat Terbit</h6>
                        <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#buatSuratModal">Buat Surat</button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive px-3">
                            <table class="table align-items-center mb-0" id="datatables">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Surat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Surat</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nomor_surat }}</td>
                                        <td>{{ $item->judul_surat }}</td>
                                        <td>
                                            <a href="{{ route('surat-terbit.download', $item->id) }}">
                                                <i class="fa-solid fa-download me-2"></i>
                                                Download
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('surat-terbit.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('surat-terbit.destroy', $item->id) }}" method="post" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
    </div>

    <div class="modal fade" id="buatSuratModal" tabindex="-1" aria-labelledby="buatSuratModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="buatSuratModalLabel">Pilih Template Surat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('surat-terbit.create') }}" class="d-inline">
                        @method('GET')
                        <select class="form-select" id="templateSelect" name="template_id" onchange="this.form.submit()">
                            <option value="" disabled selected>Pilih Template Surat</option>
                            @foreach($templates as $template)
                                <option value="{{ $template->id }}">{{ $template->nama_template }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
