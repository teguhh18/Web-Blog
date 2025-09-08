@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.role-ai.index') }}" class="btn btn-warning mb-3">Batal</a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Edit Template Image</h5>

                @if (session('msg'))
                    <div class="alert alert-danger">
                        {{ session('msg') }}
                    </div>
                @endif

                <form method="post" action="{{ route('admin.template-image.update', $templateImage->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama Template Image</label>
                        <div class="col-sm-10">
                            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name', $templateImage->name) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="template" class="col-sm-2 col-form-label">Template Image</label>
                        <div class="col-sm-10">
                            <textarea id="template" name="template" class="form-control" rows="5" required>{{ old('template', $templateImage->template) }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
