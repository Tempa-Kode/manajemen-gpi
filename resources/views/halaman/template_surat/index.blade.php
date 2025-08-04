@extends('komponent.app')

@section('title', 'Template Surat')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Daftar Template Surat</h6>
                    <a href="{{ route('template-surat.create') }}" class="btn btn-primary float-end">Tambah Template</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive px-3">
                        <table class="table align-items-center mb-0" id="datatables">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Template</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_template }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>
                                        <a href="{{ route('template-surat.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('template-surat.destroy', $item->id) }}" method="post" style="display:inline-block;">
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
@endsection
