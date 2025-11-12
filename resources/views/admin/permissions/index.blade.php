@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        @can('permission-create')
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm mb-3">
                <i class="bi bi-plus-circle-fill"></i> Tambah Permission
            </a>
        @endcan

        @if (session('success'))
            <div class="alert alert-primary bg-primary alert-dismissible fade show text-white" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $title ?? 'Daftar Permission' }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($permissions->groupBy(function ($item) {
            return explode('-', $item->name)[0];
        }) as $group => $groupPermissions)
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="card-title mb-0">
                                        <i class="bi bi-shield-lock-fill"></i> {{ ucfirst($group) }} Permissions
                                    </h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover mb-0">
                                            <tbody>
                                                @foreach ($groupPermissions as $permission)
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-success">{{ $permission->name }}</span>
                                                        </td>
                                                        <td class="text-end">
                                                            @can('permission-update')
                                                                <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                                                    class="btn btn-warning btn-sm" title="Edit">
                                                                    <i class="bi bi-pencil-fill"></i>
                                                                </a>
                                                            @endcan

                                                            @can('permission-delete')
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalDelete{{ $permission->id }}"
                                                                    title="Hapus">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </button>
                                                            @endcan
                                                        </td>
                                                    </tr>

                                                    {{-- Modal Hapus --}}
                                                    <div class="modal fade" id="modalDelete{{ $permission->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Hapus Permission</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus permission:
                                                                    <strong>{{ $permission->name }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="POST"
                                                                        action="{{ route('admin.permissions.destroy', $permission->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus</button>
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
