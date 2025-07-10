@extends('komponent.app')

@section('title', 'Data Kolekte')

@section('halaman', 'Data Kolekte')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4>Data Kolekte</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('kolekte.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-2"></i>
                            Tambah Data
                        </a>
                    </div>
                    <div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#downloadReportModal">
                            <i class="fa-solid fa-download me-2"></i>
                            Download Report PDF
                        </button>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success text-white" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table id="datatables" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Ibadah</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembangunan Gereja</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelayanan Pengerja</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pelayanan Sosial</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kolektes as $item)
                            <tr>
                                <td class="align-middle text-left text-sm">{{ $loop->iteration }}</td>
                                <td class="align-middle text-left text-sm">{{ $item->tanggal_ibadah ? $item->tanggal_ibadah->format('d/m/Y') : '-' }}</td>
                                <td class="align-middle text-left text-sm">Rp {{ number_format($item->pembangunan_gereja, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">Rp {{ number_format($item->persembahan_pelayanan_pengerja, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">Rp {{ number_format($item->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}</td>
                                <td class="align-middle text-center text-sm">
                                    <strong>Rp {{ number_format($item->pembangunan_gereja + $item->persembahan_pelayanan_pengerja + $item->persembahan_pelayanan_sosial_gereja, 0, ',', '.') }}</strong>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('kolekte.show', $item->id) }}" class="btn btn-sm btn-info me-1"
                                        data-toggle="tooltip" data-original-title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('kolekte.edit', $item->id) }}" class="btn btn-sm btn-secondary me-1"
                                        data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('kolekte.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
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

<!-- Modal Download Report -->
<div class="modal fade" id="downloadReportModal" tabindex="-1" aria-labelledby="downloadReportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadReportModalLabel">Download Report Kolekte PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('kolekte.download-report') }}" method="GET">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="filter_type" class="form-label">Pilih Jenis Filter</label>
                        <select class="form-select" id="filter_type" name="filter_type" required onchange="toggleFilterInput()">
                            <option value="">Pilih Filter</option>
                            <option value="month">Per Bulan</option>
                            <option value="year">Per Tahun</option>
                        </select>
                    </div>
                    <div class="mb-3" id="month_input" style="display: none;">
                        <label for="month_value" class="form-label">Pilih Bulan dan Tahun</label>
                        <input type="month" class="form-control" id="month_value" name="filter_value" value="{{ date('Y-m') }}">
                    </div>
                    <div class="mb-3" id="year_input" style="display: none;">
                        <label for="year_value" class="form-label">Pilih Tahun</label>
                        <input type="number" class="form-control" id="year_value" name="filter_value" min="2020" max="{{ date('Y') + 5 }}" value="{{ date('Y') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-download me-2"></i>
                        Download PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleFilterInput() {
    const filterType = document.getElementById('filter_type').value;
    const monthInput = document.getElementById('month_input');
    const yearInput = document.getElementById('year_input');
    const monthField = document.getElementById('month_value');
    const yearField = document.getElementById('year_value');

    // Hide all inputs first
    monthInput.style.display = 'none';
    yearInput.style.display = 'none';

    // Remove required attribute from all inputs
    monthField.removeAttribute('required');
    yearField.removeAttribute('required');

    // Show appropriate input based on selection
    if (filterType === 'month') {
        monthInput.style.display = 'block';
        monthField.setAttribute('required', 'required');
        monthField.setAttribute('name', 'filter_value');
        yearField.removeAttribute('name');
    } else if (filterType === 'year') {
        yearInput.style.display = 'block';
        yearField.setAttribute('required', 'required');
        yearField.setAttribute('name', 'filter_value');
        monthField.removeAttribute('name');
    }
}
</script>

@endsection
