@extends('admin.layouts.admin')

@section('main')
<div class="container mt-4">
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-warning mb-3">Batal</a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Kategori</h5>

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

            <form method="post" action="{{ route('admin.kategori.update', $kategori) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $kategori->nama) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Kategori</label>
                    <div class="col-sm-10">
                        {{-- untuk menampung gambar lama untuk dikirim ke controller --}}
                        {{-- <input type="hidden" name="oldImage" id="" value="{{ $kategori->foto }}"> --}}
                        <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()">

                        {{-- untuk preview gambar yang akan diupload atau diubah --}}
                        @if ($kategori->foto)
                            <img src="{{ asset('storage/' . $kategori->foto) }}" alt="" class="img-preview img-fluid mb-3 mt-2 col-sm-8 d-block">
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
