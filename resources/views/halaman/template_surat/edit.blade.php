@extends('komponent.app')

@section('title', 'Edit Template Surat')

@section('halaman', 'Edit Template Surat')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4 px-3">
            <div class="card-header pb-0">
                <h4 class="text-center">Edit Template Surat</h4>
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
                <form action="{{ route('template-surat.update', $template->id) }}" method="POST" class="px-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_template" class="form-control-label">Nama Template</label>
                        <input class="form-control" type="text" name="nama_template" id="nama_template" value="{{ old('nama_template', $template->nama_template) }}">
                        @error('nama_template')
                            <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-control-label">Deskripsi</label>
                        <input class="form-control" type="text" name="deskripsi" id="deskripsi" value="{{ old('deskripsi', $template->deskripsi) }}">
                        @error('deskripsi')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="template" class="form-control-label">Template</label>
                        <input class="form-control" type="file" name="template" id="template" value="{{ old('template', $template->path_file) }}">
                        @error('template')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>
                    <h5>Field Template Surat</h5>
                    <div id="fields-container">
                        @foreach($template->isianTemplates as $field)
                            <div class="field-group mb-3">
                                <input class="form-control mb-2" type="text" name="nama_field[]" value="{{ $field->nama_field }}" placeholder="Nama Field">
                                <input class="form-control mb-2" type="text" name="label[]" value="{{ $field->label }}" placeholder="Label">
                                <select name="tipe[]" class="form-control mb-2">
                                    <option value="text" {{ $field->tipe == 'text' ? 'selected' : '' }}>Text</option>
                                    <option value="number" {{ $field->tipe == 'number' ? 'selected' : '' }}>Number</option>
                                    <option value="date" {{ $field->tipe == 'date' ? 'selected' : '' }}>Date</option>
                                    <option value="textarea" {{ $field->tipe == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                    <option value="select" {{ $field->tipe == 'select' ? 'selected' : '' }}>Select</option>
                                </select>
                                <button type="button" class="btn btn-danger btn-sm remove-field">Hapus</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" id="add-field">
                        <i class="fa-solid fa-plus me-2"></i>
                        Tambah Field
                    </button>

                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Edit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.getElementById('add-field').addEventListener('click', function() {
            const container = document.getElementById('fields-container');
            const fieldGroup = container.querySelector('.field-group');
            const newGroup = fieldGroup.cloneNode(true);

            // Clear input values
            newGroup.querySelectorAll('input').forEach(input => input.value = '');
            newGroup.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

            container.appendChild(newGroup);
        });

        // Remove field group
        document.getElementById('fields-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-field')) {
                const container = document.getElementById('fields-container'); // Add this line
                const groups = container.querySelectorAll('.field-group');
                if (groups.length > 1) {
                    e.target.parentElement.remove();
                }
            }
        });
    </script>
@endpush
