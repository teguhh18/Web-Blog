@extends('admin.layouts.admin')
@section('main')
<div class="container mt-4">
    <a href="{{ route('admin.role-ai.index') }}" class="btn btn-warning mb-3">
        <i class="bi bi-arrow-left-circle-fill"></i> Kembali
    </a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Role AI</h5>

            {{-- Menampilkan pesan kesalahan validasi --}}
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif

            <form method="post" action="{{ route('admin.role-ai.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Nama Role AI</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="context" class="col-sm-2 col-form-label">Context Role AI</label>
                    <div class="col-sm-10">
                        <textarea id="context" name="context" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
