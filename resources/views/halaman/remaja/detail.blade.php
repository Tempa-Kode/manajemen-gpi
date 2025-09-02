@extends("komponent.app")

@section("title", "Detail Data Remaja")
@section("halaman", "Detail Data Remaja")

@section("content")
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
                            <a href="{{ route("data-jemaat.show", $remaja->jemaat->id) }}" class="btn btn-light">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-12 text-center mb-3">
                                <div class="avatar avatar-lg bg-success rounded-circle mx-auto mb-2"
                                    style="width:70px;height:70px;display:flex;align-items:center;justify-content:center;">
                                    @if ($remaja->jenis_kelamin == "L")
                                        <i class="fas fa-mars text-white" style="font-size:2rem;"></i>
                                    @else
                                        <i class="fas fa-venus text-white" style="font-size:2rem;"></i>
                                    @endif
                                </div>
                                <h3 class="mb-0">{{ $remaja->nama }}</h3>
                                <span class="badge bg-{{ $remaja->tgl_meninggal ? "danger" : "info" }}">
                                    {{ $remaja->tgl_meninggal ? "Meninggal" : "Remaja" }}
                                </span>
                                @if ($remaja->tgl_meninggal)
                                    <p class="text-muted mt-2 mb-0">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        Meninggal: {{ $remaja->tgl_meninggal->format("d F Y") }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-12">
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <th class="w-50">Keluarga</th>
                                        <td>{{ $remaja->jemaat->nama_keluarga ?? "-" }} (ID KK:
                                            {{ $remaja->jemaat->id_kk ?? "-" }})</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $remaja->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <td>{{ $remaja->pendidikan ?? "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ $remaja->pekerjaan ?? "-" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($remaja->tgl_meninggal)
                                                <span class="badge bg-danger">Meninggal</span>
                                                <small
                                                    class="text-muted d-block">{{ $remaja->tgl_meninggal->format("d F Y") }}</small>
                                            @else
                                                <span class="badge bg-success">Hidup</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-end gap-2">
                        @if ($remaja->tgl_meninggal)
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#resetMeninggalModal">
                                <i class="fas fa-heart me-2"></i>Kelola Status
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                data-bs-target="#meninggalModal">
                                <i class="fas fa-cross me-2"></i>Tandai Meninggal
                            </button>
                        @endif
                        <a href="{{ route("remaja.edit", $remaja->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Tandai Meninggal -->
    <div class="modal fade" id="meninggalModal" tabindex="-1" aria-labelledby="meninggalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meninggalModalLabel">
                        <i class="fas fa-cross text-warning me-2"></i>
                        Tandai Meninggal
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route("remaja.meninggal", $remaja->id) }}">>
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <p>Tandai <strong>{{ $remaja->nama }}</strong> sebagai meninggal?</p>
                        <div class="mb-3">
                            <label for="tgl_meninggal" class="form-label">Tanggal Meninggal</label>
                            <input type="date" class="form-control" id="tgl_meninggal" name="tgl_meninggal" required>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Informasi:</strong> Status ini akan mengubah tampilan data remaja.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-cross me-2"></i>Ya, Tandai Meninggal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk Reset Status Meninggal -->
    <div class="modal fade" id="resetMeninggalModal" tabindex="-1" aria-labelledby="resetMeninggalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetMeninggalModalLabel">
                        <i class="fas fa-heart text-success me-2"></i>
                        Ubah Status Menjadi Hidup
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Ubah status <strong>{{ $remaja->nama }}</strong> menjadi aktif?</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Informasi:</strong> Tanggal meninggal akan dihapus dan status akan kembali normal.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route("remaja.reset", $remaja->id) }}" class="d-inline">
                        @csrf
                        @method("PUT")
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-heart me-2"></i>Ya, Ubah Jadi Aktif
                        </button>
                    </form>
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
                    <form method="POST" action="{{ route("remaja.destroy", $remaja->id) }}" class="d-inline">
                        @csrf
                        @method("DELETE")
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
