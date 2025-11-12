@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        @can('role-create')
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm mb-3">
                <i class="bi bi-plus-circle-fill"></i> Tambah Role
            </a>
        @endcan

        @if (session('success'))
            <div class="alert alert-primary bg-primary alert-dismissible fade show text-white" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $title ?? 'Daftar Role' }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover datatable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Role</th>
                                <th>Jumlah Permissions</th>
                                <th>Jumlah Users</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $role->permissions->count() }} permissions</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $role->users->count() }} users</span>
                                    </td>
                                    <td>
                                        @can('role-read')
                                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info btn-sm"
                                                title="Detail">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endcan

                                        @can('role-update')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        @endcan

                                        @can('role-delete')
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $role->id }}" class="btn btn-danger btn-sm"
                                                title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <div class="modal fade" id="modalDelete{{ $role->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Role</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus role:
                                                <strong>{{ $role->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST"
                                                    action="{{ route('admin.roles.destroy', $role->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Hapus --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
