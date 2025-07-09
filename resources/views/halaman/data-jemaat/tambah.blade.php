@extends('komponent.app')

@section('title', 'Tambah Data Jemaat')

@section('halaman', 'Tambah Data Jemaat')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Tambah Data Jemaat</h4>
                @if ($errors->has('error'))
                    <div class="alert alert-danger text-white" role="alert">
                        <strong>Error!</strong> {{ $errors->first('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success text-white" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('data-jemaat.store') }}" method="POST" class="px-3">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="id_kk" class="form-control-label">ID KK</label>
                        <input class="form-control" type="number" name="id_kk" id="id_kk" value="{{ old('id_kk') }}">
                        @error('id_kk')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_keluarga" class="form-control-label">Nama Keluarga</label>
                        <input class="form-control" type="text" name="nama_keluarga" id="nama_keluarga" value="{{ old('nama_keluarga') }}">
                        @error('nama_keluarga')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ayah" class="form-control-label">Ayah</label>
                        <input class="form-control" type="text" name="ayah" id="ayah" value="{{ old('ayah') }}">
                        @error('ayah')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ibu" class="form-control-label">Ibu</label>
                        <input class="form-control" type="text" name="ibu" id="ibu" value="{{ old('ibu') }}">
                        @error('ibu')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-control-label">Alamat</label>
                        <input class="form-control" type="text" name="alamat" id="alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp" class="form-control-label">No Hp</label>
                        <input class="form-control" type="number" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
