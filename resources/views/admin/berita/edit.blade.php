@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.berita.index') }}" class="btn btn-warning mb-3"> <i class="bi bi-arrow-left-circle-fill"></i>
            Kembali</a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Form Berita</h5>
                <form method="POST" action="{{ route('admin.berita.update', $berita) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Judul Berita</label>
                        <div class="col-sm-10">
                            <input value="{{ $berita->title }}" type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kategori_id" class="col-sm-2 col-form-label">Kategori Berita</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="kategori_id" required>
                                <option value="">---Pilih Kategori---</option>
                                @foreach ($dataKategori as $kategori)
                                    @if (old('kategori_id', $berita->kategori_id) == $kategori->id)
                                        <option value="{{ $kategori->id }}" selected>{{ $kategori->nama }}</option>
                                    @else
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="berita" class="col-sm-2 col-form-label">Isi Berita</label>
                        <div class="col-sm-10">
                            <input value="{{ $berita->berita }}" id="berita" type="hidden" name="berita" required>
                            <trix-editor input="berita" name="berita"></trix-editor>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="foto" class="col-sm-2 col-form-label">Foto Berita</label>
                        <div class="col-sm-10">
                            {{-- untuk menampung gambar lama untuk dikirim ke controller --}}
                            {{-- <input type="hidden" name="oldImage" id="" value="{{ $berita->foto }}"> --}}
                            <input class="form-control" type="file" id="foto" name="foto"
                                onchange="previewImage()">

                            {{-- untuk preview gambar yang akan diupload atau diubah --}}
                            @if ($berita->foto)
                                <img class="img-preview img-fluid mb-3 mt-2 col-sm-8 d-block"
                                    src="{{ route('storage.show', ['path' => $berita->foto]) }}" alt="{{ $berita->title }}">
                            @else
                                <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-8">
                            @endif
                            <img src="" alt="" class="img-preview img-fluid mb-3 mt-2 col-sm-8">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
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
