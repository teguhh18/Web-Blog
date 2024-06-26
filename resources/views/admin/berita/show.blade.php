@extends('admin.layouts.admin')

@section('main')
<div class="container mt-4">
    <a href="{{ route('admin.berita.index') }}" class="btn btn-warning mb-3"> <i class="bi bi-arrow-left-circle-fill"></i> Kembali</a>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $dataBerita->title }}</h4>
            <div>
                <img class="img-fluid" src="{{ asset('storage/' . $dataBerita->foto) }}" alt=" {{  $dataBerita->title }}">
            </div>
            <div>
                {!! $dataBerita->berita !!} 
            </div>
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
