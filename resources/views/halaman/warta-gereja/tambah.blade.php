@extends('komponent.app')

@section('title', 'Tambah Warta Gereja')

@section('halaman', 'Tambah Warta Gereja')

@push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Tambah Data Warta Gereja</h4>
                @if (session('error'))
                    <div class="alert alert-warning text-white" role="alert">
                        <strong>Peringatan!</strong> {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('warta-gereja.store') }}" method="POST" class="px-3" onsubmit="simpanIsiEditor()">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="nama_warta" class="form-control-label">Nama Warta</label>
                        <input class="form-control" type="text" name="nama_warta" id="nama_warta" value="{{ old('nama_warta') }}">
                        @error('nama_warta')
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
                        <label for="warta" class="form-control-label">Warta Gereja</label>
                        <div id="editor" style="height: 80vh;"></div>
                        @error('warta')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror

                        <!-- Hidden input untuk simpan isi editor -->
                        <input class="d-none" name="warta" id="warta" value="{{ old('warta') }}">
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        function simpanIsiEditor() {
            var isiEditor = quill.root.innerHTML;
            document.getElementById('warta').value = isiEditor;
        }
    </script>
@endpush
