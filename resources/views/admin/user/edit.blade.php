@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.user.index') }}" class="btn btn-warning mb-3">Batal</a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Edit User</h5>

                {{-- Menampilkan pesan kesalahan validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="level" class="col-sm-2 col-form-label">Level User</label>
                        <div class="col-sm-10">
                            <select name="level" id="level" class="form-select">
                                <option value="">-Level User-</option>
                                <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="user" {{ $user->level == 'user' ? 'selected' : '' }}>User</option>

                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            {{-- untuk menampung gambar lama untuk dikirim ke controller --}}
                            {{-- <input type="hidden" name="oldImage" id="" value="{{ $user->foto }}"> --}}
                            <input class="form-control" type="file" id="foto" name="foto"
                                onchange="previewImage()">

                            {{-- untuk preview gambar yang akan diupload atau diubah --}}
                            @if ($user->foto)
                                <img src="{{ route('storage.show', ['path' => $user->foto]) }}" alt=""
                                    class="img-preview img-fluid mb-3 mt-2 col-sm-8 d-block">
                            @else
                                <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-8">
                            @endif
                            <img src="" alt="" class="img-preview img-fluid mb-3 mt-2 col-sm-8">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
