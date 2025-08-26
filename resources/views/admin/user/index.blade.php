@extends('admin.layouts.admin')
@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3"> <i class="bi bi-plus-circle-fill"></i>
            Tambah</a>
        <div>
            @if (session()->has('success'))
                <div class="alert alert-primary bg-primary alert-dismissible fade show text-white" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUser as $users)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $users->name }}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->level }}</td>
                                @if ($users->foto)
                                    <td class="text-center">
                                    <img src="{{ asset('storage/' . $users->foto) }}" alt="" class="img-fluid img-thumbnail rounded-circle" style="max-height: 90px;">
                                </td>
                                @else
                                <td class="text-center">
                                   No Image
                                </td>
                                @endif

                                <td>
                                    <a href="{{ route('admin.user.edit', $users->id) }}" class="btn btn-primary"> <i
                                            class="bi bi-pencil-fill"></i> Edit</a>
                                    @if ($users->id !== auth()->id())
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $users->id }}" class="btn btn-danger"> <i
                                                class="bi bi-trash-fill"></i> Hapus</button>
                                    @endif
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
                                            Apakah Kamu Yakin Ingin Hapus User : {{ $users->name }}?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="post" action="{{ route('admin.user.destroy', $users->id) }}">
                                                @csrf
                                                @method('delete')
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
@endsection
