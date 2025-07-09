@extends('komponent.app')

@section('title', 'Data Remaja')

@section('halaman', 'Data Remaja')

@section('content')
<div class="container-fluid py-4">
    <!-- Alert Success -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-1 text-success">
                                <i class="fas fa-user-graduate me-2"></i>
                                Data Remaja
                            </h3>
                            <p class="text-muted mb-0">Manajemen data remaja gereja</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('remaja.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-success text-white p-3">
                    <h5 class="mb-0">
                        <i class="fas fa-table me-2"></i>
                        Daftar Remaja
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($data->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-4 py-3">#</th>
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Keluarga</th>
                                        <th class="px-4 py-3">Umur</th>
                                        <th class="px-4 py-3">Jenis Kelamin</th>
                                        <th class="px-4 py-3">Pendidikan</th>
                                        <th class="px-4 py-3">Pekerjaan</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                        <tr>
                                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm bg-success rounded-circle me-3">
                                                        <i class="fas fa-user-graduate text-white"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->nama }}</h6>
                                                        <small class="text-muted">{{ $item->tanggal_lahir->format('d/m/Y') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="fw-bold">{{ $item->jemaat->nama_keluarga }}</span><br>
                                                <small class="text-muted">ID KK: {{ $item->jemaat->id_kk }}</small>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="badge bg-info">{{ $item->umur }} tahun</span>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($item->jenis_kelamin == 'L')
                                                    <span class="badge bg-primary">
                                                        <i class="fas fa-male me-1"></i>Laki-laki
                                                    </span>
                                                @else
                                                    <span class="badge bg-pink">
                                                        <i class="fas fa-female me-1"></i>Perempuan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $item->pendidikan ?? 'Belum diisi' }}
                                            </td>
                                            <td class="px-4 py-3">
                                                {{ $item->pekerjaan ?? 'Belum diisi' }}
                                            </td>
                                            <td class="px-4 py-3">
                                                @if($item->status == 'aktif')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check me-1"></i>Aktif
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="fas fa-times me-1"></i>Tidak Aktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('remaja.show', $item->id) }}"
                                                       class="btn btn-sm btn-outline-info" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('remaja.edit', $item->id) }}"
                                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                            title="Hapus" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data <strong>{{ $item->nama }}</strong>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <form method="POST" action="{{ route('remaja.destroy', $item->id) }}" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash me-2"></i>Ya, Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-user-graduate text-muted" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-muted">Belum ada data remaja</h5>
                            <p class="text-muted">Silakan tambahkan data remaja pertama</p>
                            <a href="{{ route('remaja.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Tambah Data Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(45deg, #198754, #20c997);
}

.bg-pink {
    background-color: #e91e63 !important;
}

.avatar {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.table tbody tr:hover {
    background-color: rgba(0,0,0,0.02);
}

.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection
