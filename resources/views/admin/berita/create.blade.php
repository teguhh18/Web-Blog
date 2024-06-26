@extends('admin.layouts.admin')

@section('main')
<div class="container mt-4">
    <a href="{{ route('admin.berita.index') }}" class="btn btn-warning mb-3"> <i class="bi bi-arrow-left-circle-fill"></i> Kembali</a>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Form Berita</h5>
            <form method="post" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Judul Berita</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kategori_id" class="col-sm-2 col-form-label">Kategori Berita</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="kategori_id" required>
                            <option value="">---Pilih Kategori---</option>
                            @foreach ($dataKategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="berita" class="col-sm-2 col-form-label">Isi Berita</label>
                    <div class="col-sm-10">
                        <input id="berita" type="hidden" name="berita" required>
                        <trix-editor input="berita" name="berita"></trix-editor>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Berita</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="foto" name="foto" onchange="previewImage()" required>
                        <img src="" alt="" class="img-preview img-fluid mb-3 mt-2 col-sm-8"> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
  // Membuat fungsi untuk preview image
  function previewImage() {
        // ambil inputan image berdasarkan id
        const image = document.querySelector('#foto');
        // ambil tag image yang kosong
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        // perintah untuk ambil data gambar
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
          imgPreview.src = oFREvent.target.result;
        }
  }
</script>
@endsection
