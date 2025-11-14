@extends('admin.layouts.admin')
@section('main')
    <div class="container mt-4">
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
                                <th width="15%">Nama User</th>
                                <th width="35%">Post</th>
                                <th width="35%">Comment</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ ucwords($comment->user->name) }}</strong>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $comment->berita->title ?? 'Deleted Post' }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $comment->comment }}</span>
                                    </td>
                                    <td>
                                        @can('comment-delete')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $comment->id }}" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        @endcan
                                    </td>
                                </tr>

                                {{-- Modal Hapus --}}
                                <div class="modal fade" id="modalDelete{{ $comment->id }}" tabindex="-1">
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
                                                <p class="mb-1">Apakah Anda yakin ingin menghapus Comment ini?</p>
                                                <p class="text-muted mt-2 mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle"></i> Batal
                                                </button>
                                                <form method="post"
                                                    action="{{ route('admin.comment.destroy', $comment) }}"
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
                                {{-- End Modal Hapus --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
