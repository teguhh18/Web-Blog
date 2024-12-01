@extends('admin.layouts.admin')

@section('main')
<div class="container mt-4">
    <a href="{{ route('admin.berita.index') }}" class="btn btn-warning mb-3"> <i class="bi bi-arrow-left-circle-fill"></i> Kembali</a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Berita</h5>
            <form method="post" action="{{ route('generate.berita') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="topik" class="col-sm-2 col-form-label">Topik Postingan</label>
                    <div class="col-sm-10">
                        <input type="text" name="topik" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
