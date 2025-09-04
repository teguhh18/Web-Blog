@extends('admin.layouts.admin')
@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle-fill"></i> Tambah
        </a>
        
        @if (session()->has('success'))
            <div class="alert alert-primary bg-primary alert-dismissible fade show text-white mb-3" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
             <div class="card-header">
                <h5 class="card-title mb-0">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-hover datatable">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">Nama</th>
                            <th width="25%">Email</th>
                            <th width="10%">Level</th>
                            <th width="15%" class="text-center">Foto</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $users)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->level }}</td>
                                <td class="text-center align-middle">
                                    @if ($users->foto)
                                        <img src="{{ asset('storage/' . $users->foto) }}" 
                                             alt="User Photo" 
                                             class="img-thumbnail rounded-circle" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light rounded-circle mx-auto" 
                                             style="width: 60px; height: 60px;">
                                            <i class="bi bi-person-fill text-muted" style="font-size: 24px;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-info dropdown-toggle" 
                                                type="button" 
                                                id="dropdownMenuButton{{ $users->id }}"
                                                data-bs-toggle="dropdown" 
                                                aria-expanded="false">
                                            <i class="bi bi-list"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" 
                                            aria-labelledby="dropdownMenuButton{{ $users->id }}">
                                            <li>
                                                <a class="dropdown-item btn btn-warning" 
                                                   href="{{ route('admin.user.edit', $users->id) }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </a>
                                            </li>
                                            @if ($users->id !== auth()->id())
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <button type="button" 
                                                            class="dropdown-item text-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalDelete{{ $users->id }}">
                                                        <i class="bi bi-trash3 me-2"></i>Hapus
                                                    </button>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="modalDelete{{ $users->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Hapus User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Kamu Yakin Ingin Hapus User : <strong>{{ $users->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <form method="post" action="{{ route('admin.user.destroy', $users->id) }}" 
                                                  class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
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
