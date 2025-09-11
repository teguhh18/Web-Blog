@extends('admin.layouts.admin')
@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.tools.create') }}" class="btn btn-primary btn-sm mb-3"> <i
                class="bi bi-plus-circle-fill"></i>
            Tambah</a>
        <div>
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
        </div>
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
                                <th width="20%">Nama</th>
                                <th width="10%">Slug</th>
                                <th width="50%">Description</th>
                                <th width="5%">Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tools as $tool)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ ucwords($tool->name) }}</strong>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $tool->slug }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $tool->description }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $tool->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tools.edit', $tool->id) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil-fill" title="Edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $tool->id }}">
                                            <i class="bi bi-trash-fill" title="Hapus"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <div class="modal fade" id="modalDelete{{ $tool->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">
                                                    <i class="bi bi-exclamation-triangle"></i> Konfirmasi Hapus
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-1">Apakah Anda yakin ingin menghapus tool:</p>
                                                <strong>{{ $tool->name }}</strong>
                                                <p class="text-muted mt-2 mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle"></i> Batal
                                                </button>
                                                <form method="post"
                                                    action="{{ route('admin.tools.destroy', $tool->id) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="bi bi-trash-fill"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
