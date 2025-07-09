@extends('komponent.app')

@section('title', 'Edit Data Jadwal Ibadah')

@section('halaman', 'Edit Data Jadwal Ibadah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Edit Data Jadwal Ibadah</h4>
                @if (session('error'))
                    <div class="alert alert-warning text-white" role="alert">
                        <strong>Peringatan!</strong> {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('jadwal-ibadah.update', $data->id) }}" method="POST" class="px-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="jenis_ibadah_id" class="form-control-label">Jenis Ibadah</label>
                        <select name="jenis_ibadah_id" id="jenis_ibadah_id" class="form-control">
                            <option value="" disabled>Pilih Jenis Ibadah</option>
                            @foreach ($jenisIbadah as $jenis)
                                <option value="{{ $jenis->id }}"
                                    {{ old('jenis_ibadah_id', $data->jenis_ibadah_id) == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->jenis_ibadah }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_ibadah_id')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hari" class="form-control-label">Hari</label>
                        <select name="hari" id="hari" class="form-control">
                            <option value="" disabled selected>Pilih Hari</option>
                            <option value="Senin" {{ old('hari', $data->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ old('hari', $data->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ old('hari', $data->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ old('hari', $data->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ old('hari', $data->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                            <option value="Sabtu" {{ old('hari', $data->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                            <option value="Minggu" {{ old('hari', $data->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        </select>
                        @error('hari')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal" class="form-control-label">Date</label>
                        <input class="form-control" type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $data->tanggal ? $data->tanggal->format('Y-m-d') : '') }}">
                        @error('tanggal')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jam" class="form-control-label">Jam</label>
                        <input class="form-control" type="time" value="{{ old('jam', \Carbon\Carbon::parse($data->jam)->format('H:i')) }}" id="jam" name="jam">
                        @error('jam')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tempat" class="form-control-label">Tempat</label>
                        <select name="tempat" id="tempat" class="form-control">
                            <option value="gereja" {{ old('tempat', $data->tempat) == 'gereja' ? 'selected' : '' }}>Gedung Gereja</option>
                            @foreach ($rumahKeluarga as $rumah)
                                <option value="{{ $rumah->nama_keluarga }}" {{ old('tempat', $data->tempat) == $rumah->nama_keluarga ? 'selected' : '' }}>
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
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap ibadah (opsional)">{{ old('alamat', $data->alamat) }}</textarea>
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
