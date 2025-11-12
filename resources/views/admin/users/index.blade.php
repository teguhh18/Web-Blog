@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        @can('user-create')
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm mb-3">
                <i class="bi bi-plus-circle-fill"></i> Tambah User
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
                <h5 class="card-title mb-0">{{ $title ?? 'Daftar User' }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover datatable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @can('user-read')
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info btn-sm"
                                                title="Detail">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endcan

                                        @can('user-update')
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        @endcan

                                        @can('user-delete')
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalDelete{{ $user->id }}" class="btn btn-danger btn-sm"
                                                title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <div class="modal fade" id="modalDelete{{ $user->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus user:
                                                <strong>{{ $user->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form method="POST"
                                                    action="{{ route('admin.users.destroy', $user->id) }}">
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
