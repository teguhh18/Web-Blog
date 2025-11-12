@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left-circle-fill"></i> Kembali
            </a>
            @can('user-update')
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil-fill"></i> Edit
                </a>
            @endcan
        </div>

        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Detail User: {{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Nama Lengkap</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
            
                    <tr>
                        <th>Role</th>
                        <td>
                            @foreach ($user->roles as $role)
                                <span class="badge bg-primary">{{ ucfirst($role->name) }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Permissions</th>
                        <td>
                            @if ($user->getAllPermissions()->count() > 0)
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($user->getAllPermissions() as $permission)
                                        <span class="badge bg-success">{{ $permission->name }}</span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">Tidak ada permission</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat Pada</th>
                        <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diupdate</th>
                        <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
