@extends('komponent.app')

@section('title', 'Dashboard - Manajemen GPI')

@section('halaman', 'Dashboard')

@section('content')
    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pengguna</p>
                                <h5 class="font-weight-bolder">
                                    {{ $dataPengguna }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Admin: {{ $dataAdmin }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Jemaat</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalJemaat }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Dewasa & Anak</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world-2 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Sekolah Minggu</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalSekolahMinggu }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Siswa Aktif</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Remaja</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalRemaja }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Aktif</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-satisfied text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics Row -->
    <div class="row mt-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Jadwal Ibadah</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalJadwalIbadah }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-info text-sm font-weight-bolder">Total Jadwal</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pendaftaran Ibadah</p>
                                <h5 class="font-weight-bolder">
                                    {{ $totalPendaftaranIbadah }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Total Pendaftar</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-dark shadow-dark text-center rounded-circle">
                                <i class="ni ni-badge text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Kolekte Bulan Ini</p>
                                <h5 class="font-weight-bolder">
                                    Rp {{ number_format(($kolekteBulanIni->total_pembangunan ?? 0) + ($kolekteBulanIni->total_pengerja ?? 0) + ($kolekteBulanIni->total_sosial ?? 0), 0, ',', '.') }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">Total Kolekte</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-secondary shadow-secondary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pendaftar Bulan Ini</p>
                                <h5 class="font-weight-bolder">
                                    {{ $pendaftaranBulanIni }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-info text-sm font-weight-bolder">Orang</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <!-- Kolekte Chart -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h6>Statistik Kolekte (6 Bulan Terakhir)</h6>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleKolekteChart('line')">Line</button>
                            <button type="button" class="btn btn-sm btn-outline-primary active" onclick="toggleKolekteChart('bar')">Bar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="kolekteChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Pendaftaran Ibadah Chart -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Pendaftaran per Jenis Ibadah</h6>
                </div>
                <div class="card-body">
                    <canvas id="pendaftaranChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables Section -->
    <div class="row mt-4">
        <!-- Kolekte Details Table -->
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Detail Kolekte 6 Bulan Terakhir</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Periode</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pembangunan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pengerja</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sosial</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kolekteData as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ \Carbon\Carbon::createFromDate($data->tahun, $data->bulan, 1)->locale('id')->isoFormat('MMMM Y') }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Rp {{ number_format($data->total_pembangunan, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Rp {{ number_format($data->total_pengerja, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">Rp {{ number_format($data->total_sosial, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0 text-success">Rp {{ number_format($data->total_pembangunan + $data->total_pengerja + $data->total_sosial, 0, ',', '.') }}</p>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data kolekte</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendaftaran Details Table -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Detail Pendaftaran per Jenis Ibadah</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Ibadah</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftaranPerJenis as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $data->jenis_ibadah }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $data->total }} orang</p>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center">Belum ada data pendaftaran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .btn-group .btn.active {
        background-color: #5e72e4;
        border-color: #5e72e4;
        color: white;
    }
    .card-header h6 {
        color: #344767;
        font-weight: 600;
    }
    .table td, .table th {
        padding: 0.75rem;
        vertical-align: middle;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk chart kolekte
    const kolekteData = @json($kolekteData);

    // Persiapkan data untuk chart
    const labels = kolekteData.map(item => {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        return months[item.bulan - 1] + ' ' + item.tahun;
    }).reverse();

    const pembangunanData = kolekteData.map(item => item.total_pembangunan || 0).reverse();
    const pengerjaData = kolekteData.map(item => item.total_pengerja || 0).reverse();
    const sosialData = kolekteData.map(item => item.total_sosial || 0).reverse();

    // Kolekte Chart
    const kolekteCtx = document.getElementById('kolekteChart').getContext('2d');
    let kolekteChart = new Chart(kolekteCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pembangunan Gereja',
                data: pembangunanData,
                backgroundColor: 'rgba(94, 114, 228, 0.8)',
                borderColor: 'rgba(94, 114, 228, 1)',
                borderWidth: 1
            }, {
                label: 'Pelayanan Pengerja',
                data: pengerjaData,
                backgroundColor: 'rgba(255, 99, 132, 0.8)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Pelayanan Sosial',
                data: sosialData,
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Pendaftaran Chart
    const pendaftaranData = @json($pendaftaranPerJenis);
    const pendaftaranCtx = document.getElementById('pendaftaranChart').getContext('2d');

    new Chart(pendaftaranCtx, {
        type: 'doughnut',
        data: {
            labels: pendaftaranData.map(item => item.jenis_ibadah),
            datasets: [{
                data: pendaftaranData.map(item => item.total),
                backgroundColor: [
                    'rgba(94, 114, 228, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                borderColor: [
                    'rgba(94, 114, 228, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Function to toggle chart type
    function toggleKolekteChart(type) {
        // Update button active state
        document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        // Destroy existing chart and create new one
        kolekteChart.destroy();
        kolekteChart = new Chart(kolekteCtx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pembangunan Gereja',
                    data: pembangunanData,
                    backgroundColor: type === 'line' ? 'rgba(94, 114, 228, 0.2)' : 'rgba(94, 114, 228, 0.8)',
                    borderColor: 'rgba(94, 114, 228, 1)',
                    borderWidth: 2,
                    fill: type === 'line' ? false : true
                }, {
                    label: 'Pelayanan Pengerja',
                    data: pengerjaData,
                    backgroundColor: type === 'line' ? 'rgba(255, 99, 132, 0.2)' : 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: type === 'line' ? false : true
                }, {
                    label: 'Pelayanan Sosial',
                    data: sosialData,
                    backgroundColor: type === 'line' ? 'rgba(75, 192, 192, 0.2)' : 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: type === 'line' ? false : true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
