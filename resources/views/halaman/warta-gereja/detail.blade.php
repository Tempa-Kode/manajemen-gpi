@extends('komponent.app')

@section('title', 'Detail Warta Gereja')

@section('halaman', 'Detail Warta Gereja')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Detail Warta Gereja</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="form-group">
                    <label for="nama_warta" class="form-control-label">Nama Warta</label>
                    <input readonly class="form-control" type="text" name="nama_warta" id="nama_warta" value="{{ old('nama_warta', $data->nama_warta) }}">
                </div>
                <div class="form-group">
                    <label for="tanggal" class="form-control-label">Date</label>
                    <input readonly class="form-control" type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $data->tanggal) }}">
                </div>
            </div>
        </div>

        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Warta Gereja</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                {!! $data->warta !!}
            </div>
        </div>
    </div>
</div>
@endsection
