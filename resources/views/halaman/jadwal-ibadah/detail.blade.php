@extends('komponent.app')

@section('title', 'Detail Jadwal Ibadah')

@section('halaman', 'Detail Jadwal Ibadah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Detail Jadwal Ibadah</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="form-group">
                    <label for="jenis_ibadah" class="form-control-label">Jenis Ibadah</label>
                    <input readonly class="form-control" type="text" name="jenis_ibadah" id="jenis_ibadah" value="{{ $data->jenisIbadah->jenis_ibadah ?? 'Tidak ada jenis' }}">
                </div>
                <div class="form-group">
                    <label for="hari" class="form-control-label">Hari</label>
                    <select disabled name="hari" id="hari" class="form-control">
                        <option value="" disabled selected>Pilih Hari</option>
                        <option value="Senin" {{ old('hari', $data->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                        <option value="Selasa" {{ old('hari', $data->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="Rabu" {{ old('hari', $data->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="Kamis" {{ old('hari', $data->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="Jumat" {{ old('hari', $data->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="Sabtu" {{ old('hari', $data->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                        <option value="Minggu" {{ old('hari', $data->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal" class="form-control-label">Date</label>
                    <input readonly class="form-control" type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $data->tanggal ? $data->tanggal->format('Y-m-d') : '') }}">
                </div>
                <div class="form-group">
                    <label for="jam" class="form-control-label">Jam</label>
                    <input readonly class="form-control" type="time" value="{{ old('jam', $data->jam) }}" id="jam" name="jam">
                </div>
                <div class="form-group">
                    <label for="tempat" class="form-control-label">Tempat</label>
                    <input readonly class="form-control" type="text" value="{{ $data->tempat ?? 'Tidak diisi' }}" id="tempat" name="tempat">
                </div>
                <div class="form-group">
                    <label for="alamat" class="form-control-label">Alamat Lengkap</label>
                    <textarea readonly class="form-control" name="alamat" id="alamat" rows="3">{{ $data->alamat ?? 'Tidak diisi' }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Pendaftar Ibadah</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="datatables" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Telp</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->pendaftarIbadah as $item)
                                <tr>
                                    <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-left text-sm">{{ $item->user->name }}</td>
                                    <td class="align-middle text-center text-sm">{{ $item->user->username }}</td>
                                    <td class="align-middle text-center text-sm">{{ $item->user->no_telp }}</td>
                                    <td class="align-middle text-center text-sm">{{ $item->user->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
