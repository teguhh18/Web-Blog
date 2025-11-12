@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.roles.index') }}" class="btn btn-warning mb-3">
            <i class="bi bi-arrow-left-circle-fill"></i> Kembali
        </a>

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Form Tambah Role</h5>
            </div>
            <div class="card-body mt-2">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama Role <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Masukkan nama role" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Permissions</label>
                        <div class="col-sm-10">
                            <div class="row">
                                @foreach ($permissions->groupBy(function ($item) {
            return explode('-', $item->name)[0];
        }) as $group => $groupPermissions)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="card-header bg-info text-white">
                                                <h6 class="card-title mb-0">
                                                    <i class="bi bi-shield-check"></i> {{ ucfirst($group) }}
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($groupPermissions as $permission)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                                            value="{{ $permission->name }}"
                                                            id="permission_{{ $permission->id }}"
                                                            {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="permission_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save-fill"></i> Simpan
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle-fill"></i> Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
