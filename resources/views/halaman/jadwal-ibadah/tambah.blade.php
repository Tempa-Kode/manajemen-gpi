@extends('komponent.app')

@section('title', 'Tambah Data Jadwal Ibadah')

@section('halaman', 'Tambah Data Jadwal Ibadah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Tambah Data Jadwal Ibadah</h4>
                @if (session('error'))
                    <div class="alert alert-warning text-white" role="alert">
                        <strong>Peringatan!</strong> {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('jadwal-ibadah.store') }}" method="POST" class="px-3">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="jenis_ibadah" class="form-control-label">Jenis Ibadah</label>
                        <input class="form-control" type="text" name="jenis_ibadah" id="jenis_ibadah" value="{{ old('jenis_ibadah') }}">
                        @error('jenis_ibadah')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hari" class="form-control-label">Hari</label>
                        <select name="hari" id="hari" class="form-control">
                            <option value="" disabled selected>Pilih Hari</option>
                            <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ old('hari') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                        @error('hari')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal" class="form-control-label">Date</label>
                        <input class="form-control" type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jam" class="form-control-label">Jam</label>
                        <input class="form-control" type="time" value="{{ old('jam') }}" id="jam" name="jam">
                        @error('jam')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tempat" class="form-control-label">Tempat</label>
                        <select name="tempat" id="tempat" class="form-control">
                            <option value="gereja">Gedung Gereja</option>
                            @foreach ($rumahKeluarga as $rumah)
                                <option value="{{ $rumah->nama_keluarga }}" {{ old('tempat') == $rumah->nama_keluarga ? 'selected' : '' }}>
                                    {{ $rumah->nama_keluarga }}
                                </option>
                            @endforeach
                        </select>
                        @error('tempat')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="form-control-label">Alamat Lengkap</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap ibadah (opsional)">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn bg-gradient-primary">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
