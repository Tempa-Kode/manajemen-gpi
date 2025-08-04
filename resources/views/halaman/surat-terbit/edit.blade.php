@extends('komponent.app')

@section('title', 'Edit Surat Terbit')

@section('halaman', 'Edit Surat Terbit')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="card-header pb-0">
                    <h4 class="text-center">{{ $template->nama_template }}</h4>
                    @if (session('error'))
                        <div class="alert alert-warning text-white" role="alert">
                            <strong>Peringatan!</strong> {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('surat-terbit.update', $suratTerbit->id) }}" method="POST" class="px-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="template_id" value="{{ $template->id }}">
                        <div class="form-group">
                            <label for="nomor_surat" class="form-control-label">Nomor Surat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat', $suratTerbit->nomor_surat) }}">
                            @error('nomor_surat')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="judul_surat" class="form-control-label">Judul Surat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="judul_surat" id="judul_surat" value="{{ old('judul_surat', $suratTerbit->judul_surat) }}">
                            @error('judul_surat')
                                <span class="text-danger fst-italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>
                        <h5>Field Surat</h5>
                        @foreach($template->isianTemplates as $field)
                            @php
                                $isian = $suratTerbit->isianSurat
                                    ? $suratTerbit->isianSurat->firstWhere('nama_field', $field->nama_field)
                                    : null;
                            @endphp
                            <div class="mb-3">
                                <label for="{{ $field->nama_field }}" class="form-label">{{ $field->label }}</label>
                                <input type="hidden" name="nama_field[]" value="{{ $field->nama_field }}">
                                <input type="{{ $field->tipe }}"
                                   class="form-control"
                                   id="{{ $field->nama_field }}"
                                   name="isi_field[]"
                                   value="{{ old('isi_field.' . $loop->index, $isian ? $isian->isi_field : '') }}">
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i>
                            Edit Surat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
