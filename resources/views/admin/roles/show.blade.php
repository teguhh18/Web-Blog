@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left-circle-fill"></i> Kembali
            </a>
            @can('role-update')
                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-fill"></i> Edit
                </a>
            @endcan
        </div>

        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Detail Role: {{ ucfirst($role->name) }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Nama Role</th>
                        <td><span class="badge bg-primary">{{ ucfirst($role->name) }}</span></td>
                    </tr>
                    <tr>
                        <th>Jumlah Users</th>
                        <td><span class="badge bg-success">{{ $role->users->count() }} users</span></td>
                    </tr>
                    <tr>
                        <th>Permissions</th>
                        <td>
                            @if ($role->permissions->count() > 0)
                                <div class="row">
                                    @foreach ($role->permissions->groupBy(function ($item) {
            return explode('-', $item->name)[0];
        }) as $group => $groupPermissions)
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header bg-secondary text-white">
                                                    <h6 class="mb-0">
                                                        <i class="bi bi-shield-check"></i> {{ ucfirst($group) }}
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($groupPermissions as $permission)
                                                        <span class="badge bg-success mb-1">{{ $permission->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">Tidak ada permission</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $role->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diupdate</th>
                        <td>{{ $role->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
