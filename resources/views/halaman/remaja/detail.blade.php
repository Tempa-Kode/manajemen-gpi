@extends('komponent.app')

@section('title', 'Detail Data Remaja')
@section('halaman', 'Detail Data Remaja')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-success text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white">
                            <i class="fas fa-user-graduate me-2"></i>
                            Detail Data Remaja
                        </h4>
                        <a href="{{ route('data-jemaat.show', $remaja->jemaat->id) }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-12 text-center mb-3">
                            <div class="avatar avatar-lg bg-success rounded-circle mx-auto mb-2" style="width:70px;height:70px;display:flex;align-items:center;justify-content:center;">
                                @if($remaja->jenis_kelamin == 'L')
                                    <i class="fas fa-mars text-white" style="font-size:2rem;"></i>
                                @else
                                    <i class="fas fa-venus text-white" style="font-size:2rem;"></i>
                                @endif
                            </div>
                            <h3 class="mb-0">{{ $remaja->nama }}</h3>
                            <span class="badge bg-info">Remaja</span>
                        </div>
                        <div class="col-12">
                            <table class="table table-borderless mb-0">
                                <tr>
                                    <th class="w-50">Keluarga</th>
                                    <td>{{ $remaja->jemaat->nama_keluarga ?? '-' }} (ID KK: {{ $remaja->jemaat->id_kk ?? '-' }})</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $remaja->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <th>Pendidikan</th>
                                    <td>{{ $remaja->pendidikan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan</th>
                                    <td>{{ $remaja->pekerjaan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Terdaftar Sejak</th>
                                    <td>{{ $remaja->created_at->format('d F Y, H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                    <a href="{{ route('remaja.edit', $remaja->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus data remaja <strong>{{ $remaja->nama }}</strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-warning me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('remaja.destroy', $remaja->id) }}" class="d-inline">
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

<style>
.bg-gradient-success {
    background: linear-gradient(45deg, #198754, #20c997);
}
.avatar-lg {
    width: 70px;
    height: 70px;
    font-size: 2rem;
}
</style>
@endsection
