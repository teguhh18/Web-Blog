@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <a href="{{ route('admin.berita.index') }}" class="btn btn-warning mb-3">
            <i class="bi bi-arrow-left-circle-fill"></i> Kembali
        </a>

        <div class="card shadow">
            <!-- Form Generate AI -->
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Form Generate AI</h5>
            </div>
            <div class="card-body mt-2">
                <div class="row mb-3">
                    <label for="role_ai" class="col-sm-2 col-form-label">Role AI</label>
                    <div class="col-sm-10">
                        <select name="role_ai" id="role_ai" class="form-select" required>
                            <option value="">---Pilih Role AI---</option>
                            @foreach ($roleAi as $ai)
                                <option value="{{ $ai->id }}">{{ $ai->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="prompt" class="col-sm-2 col-form-label">Prompt</label>
                    <div class="col-sm-10">
                        <input type="text" id="prompt" name="prompt" class="form-control" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="button" class="btn btn-success btn-generate">
                            <i class="bi bi-lightning-fill"></i> Generate
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Berita -->
        <div class="card shadow mt-4">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">Form Berita</h5>
            </div>
            <div class="card-body mt-2">
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
                            <trix-editor input="berita" name="berita" id="berita-editor"></trix-editor>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="foto" class="col-sm-2 col-form-label">Foto Berita</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="file" id="foto" name="foto"
                                onchange="previewImage()" required>
                            <img src="" alt="" class="img-preview img-fluid mb-3 mt-2 col-sm-8 d-none">
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-primary" id="btn-generate-image">
                                <i class="bi bi-image"></i> Generate Image
                            </button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Berita
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", ".btn-generate", function() {
                const role_ai = $('#role_ai').val();
                const prompt = $('#prompt').val();
                const berita = $('#berita').val();

                // Tampilkan animasi loading
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'AI Sedang Generate Postingan Berjudul ' + prompt + ' Untukmu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                });

                $.get("{{ route('admin.ai.generate') }}", {
                    prompt: prompt,
                    role_ai: role_ai
                }, function(res) {
                    if (res.status === 'success') {
                        $('#berita').val(res.data);
                        const trixEditor = document.querySelector("trix-editor[input='berita']");
                        trixEditor.editor.loadHTML(res.data);

                        Swal.fire({
                            title: 'Success!',
                            text: 'Generate Berhasil, Cek di Form Berita',
                            icon: 'success',
                        })
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong, Try again Later',
                            icon: 'error',
                        })
                    }
                });
            })

            $(document).on("click", "#btn-generate-image", function() {
                const berita = $('#berita').val();

                if (!berita) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Isi Berita Dulu Sebelum Generate Image',
                        icon: 'error',
                    })
                    return;
                }

                // Tampilkan animasi loading
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'AI Sedang Generate Image untukmu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                });

                $.get("{{ route('admin.ai.generate.image') }}", {
                    text: berita
                }, function(res) {
                    if (res.status === 'success') {
                        // Tampilkan preview gambar
                        $('.img-preview').removeClass('d-none');
                        $('.img-preview').attr('src', res.data);

                        Swal.fire({
                            title: 'Success!',
                            text: 'Generate Image Berhasil, Cek di Form Berita',
                            icon: 'success',
                        })
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong, Try again Later',
                            icon: 'error',
                        })
                    }
                });
            })
        })
    </script>
@endpush
