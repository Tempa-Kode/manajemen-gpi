@extends('komponent.app')

@section('title', 'Tambah Data Kolekte')

@section('halaman', 'Tambah Data Kolekte')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Tambah Data Kolekte</h4>
                @if (session('error'))
                    <div class="alert alert-warning text-white" role="alert">
                        <strong>Peringatan!</strong> {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('kolekte.store') }}" method="POST" class="px-3">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="jadwal_ibadah_id" class="form-control-label">Jadwal Ibadah (Optional)</label>
                        <select class="form-control js-example-basic-single" name="jadwal_ibadah_id" id="jadwal_ibadah_id">
                            <option value="">Pilih Jadwal Ibadah</option>
                            @foreach ($jadwalIbadahs as $jadwal)
                                <option value="{{ $jadwal->id }}" {{ old('jadwal_ibadah_id') == $jadwal->id ? 'selected' : '' }}>
                                    {{ $jadwal->jenisIbadah->jenis_ibadah ?? 'Tidak ada' }} - {{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('jadwal_ibadah_id')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_ibadah" class="form-control-label">Tanggal Ibadah</label>
                        <input class="form-control" type="date" name="tanggal_ibadah" id="tanggal_ibadah"
                               value="{{ old('tanggal_ibadah') }}">
                        @error('tanggal_ibadah')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pembangunan_gereja" class="form-control-label">Pembangunan Gereja</label>
                        <input class="form-control" type="number" name="pembangunan_gereja" id="pembangunan_gereja"
                               value="{{ old('pembangunan_gereja') }}" step="0.01" min="0">
                        @error('pembangunan_gereja')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="persembahan_pelayanan_pengerja" class="form-control-label">Persembahan Pelayanan Pengerja</label>
                        <input class="form-control" type="number" name="persembahan_pelayanan_pengerja" id="persembahan_pelayanan_pengerja"
                               value="{{ old('persembahan_pelayanan_pengerja') }}" step="0.01" min="0">
                        @error('persembahan_pelayanan_pengerja')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="persembahan_pelayanan_sosial_gereja" class="form-control-label">Persembahan Pelayanan Sosial Gereja</label>
                        <input class="form-control" type="number" name="persembahan_pelayanan_sosial_gereja" id="persembahan_pelayanan_sosial_gereja"
                               value="{{ old('persembahan_pelayanan_sosial_gereja') }}" step="0.01" min="0">
                        @error('persembahan_pelayanan_sosial_gereja')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="form-control-label">Keterangan (Optional)</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kolekte.index') }}" class="btn btn-secondary ms-2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
