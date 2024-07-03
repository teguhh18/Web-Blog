@extends('admin.layouts.admin')

@section('main')
<div class="container mt-4">
    <a href="{{ route('admin.user.index') }}" class="btn btn-warning mb-3">
        <i class="bi bi-arrow-left-circle-fill"></i> Kembali
    </a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Kategori</h5>

            {{-- Menampilkan pesan kesalahan validasi
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">Nama User</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                   
                    <label for="level" class="col-sm-3 col-form-label">Level</label>
                    <div class="col-sm-10">
                    <select name="level" id="level" class="form-control">
                        <option value="{{ old('level') }}">-Level User-</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-3 col-form-label">Foto User</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()" required>
                        <img src="" alt="" class="img-preview img-fluid mb-3 mt-2 col-sm-8">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah</button>
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
