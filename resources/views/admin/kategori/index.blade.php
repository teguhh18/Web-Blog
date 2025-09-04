@extends('admin.layouts.admin')
@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3"> <i class="bi bi-plus-circle-fill"></i> Tambah</a>
        <div>
            @if (session()->has('success'))
                <div class="alert alert-primary bg-primary alert-dismissible fade show text-white" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $title }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover datatable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataKategori as $kategori)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $kategori->foto) }}" alt="" class="img-fluid img-thumbnail" style="max-height: 100px;">
                            </td>
                            
                            <td>
                                <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-primary"> <i class="bi bi-pencil-fill"></i> Edit</a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $kategori->id }}"
                                    class="btn btn-danger"> <i class="bi bi-trash-fill"></i> Hapus</button>
                            </td>
                        </tr>

                        {{-- Modal Hapus --}}
                        <div class="modal fade" id="modalDelete{{ $kategori->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Hapus Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Kamu Yakin Ingin Hapus Kategori : {{ $kategori->nama }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form method="post" action="{{ route('admin.kategori.destroy', $kategori->id) }}">
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
    </div>
@endsection
