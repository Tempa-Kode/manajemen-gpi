@extends('komponent.app')

@section('halaman', 'Kolekte Umum')

@section('title', 'Tambah Data Kolekte Umum - Manajemen GPI')

@section('halaman', 'Tambah Data Kolekte Umum')

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
                <form action="{{ route('kolekte-umum.store') }}" method="POST" class="px-3">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="jadwal_ibadah_id" class="form-control-label">Jadwal Ibadah (Optional)</label>
                        <select class="form-control js-example-basic-single" name="jadwal_ibadah_id" id="jadwal_ibadah_id">
                            <option value="">Pilih Jadwal Ibadah</option>
                            @foreach ($jadwalIbadah as $jadwal)
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
                        <label for="nominal" class="form-control-label">Nominal</label>
                        <input class="form-control" type="number" name="nominal" id="nominal"
                               value="{{ old('nominal') }}">
                        @error('nominal')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kolekte-umum.index') }}" class="btn btn-secondary ms-2">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
