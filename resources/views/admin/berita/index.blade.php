@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary mb-3"> <i class="bi bi-plus-circle-fill"></i> Tambah</a>
        <a href="{{ route('admin.ai') }}" class="btn btn-info mb-3"> <i class="bi bi-lightning-fill"></i> Buat Dengan AI</a>

        <div>
            @if (session()->has('success'))
                <div class="alert alert-primary bg-primary alert-dismissible fade show text-white" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="card">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataBerita as $berita)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $berita->title }}</td>
                            <td>{{ $berita->kategori->nama }}</td>
                            <td>{{ $berita->user->name }}</td>
                            
                            <td>
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-warning"> <i class="bi bi-pencil-fill"></i> Edit</a>
                                <a href="{{ route('admin.berita.show', $berita->id) }}" class="btn btn-primary"> <i class="bi bi-eye-fill"></i> Lihat</a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $berita->id }}"
                                    class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Hapus</button>
                            </td>
                        </tr>

                        {{-- Modal Hapus --}}
                        <div class="modal fade" id="modalDelete{{ $berita->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Berita</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Kamu Yakin Ingin Hapus Berita: {{ $berita->title }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" action="{{ route('admin.berita.destroy', $berita) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
@endsection
