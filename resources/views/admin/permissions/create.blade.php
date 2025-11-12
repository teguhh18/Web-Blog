@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-warning mb-3">
            <i class="bi bi-arrow-left-circle-fill"></i> Kembali
        </a>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Form Tambah Permission</h5>
            </div>
            <div class="card-body mt-2">
                <form action="{{ route('admin.permissions.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama Permission <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Contoh: user-create, post-read"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: resource-action (contoh: user-create, post-delete)</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save-fill"></i> Simpan
                            </button>
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle-fill"></i> Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
