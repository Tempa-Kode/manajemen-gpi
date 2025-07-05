@extends('komponent.app')

@section('title', 'Edit Data Jemaat')

@section('halaman', 'Edit Data Jemaat')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Edit Data Jemaat</h4>
                @if (session('error'))
                    <div class="alert alert-warning text-white" role="alert">
                        <strong>Peringatan!</strong> {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('jemaat.update', $user->id) }}" method="POST" class="px-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama" class="form-control-label">Nama</label>
                        <input class="form-control" type="text" name="name" id="nama" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-control-label">Username</label>
                        <input class="form-control" type="text" id="username" name="username" value="{{ old('username', $user->username) }}">
                        @error('username')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-control-label">Email</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}">
                        @error('password')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-control-label">Konfirmasi Password</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp" class="form-control-label">No Telp</label>
                        <input class="form-control" type="number" name="no_telp" id="no_telp" value="{{ old('no_telp', $user->no_telp) }}">
                        @error('no_telp')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                        <div class="d-flex">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="laki-laki">Laki-Laki</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        @error('jenis_kelamin')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-control-label">Alamat</label>
                        <input class="form-control" type="text" name="alamat" id="alamat" value="{{ old('alamat', $user->alamat) }}">
                        @error('alamat')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-pen-to-square me-2"></i>
                        Edit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
