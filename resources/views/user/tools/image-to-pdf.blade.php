@extends('user.new-layouts.main')
@section('main')
    <div class="container mx-auto p-4 md:p-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h1 class="card-title text-2xl md:text-3xl">Konverter Gambar ke PDF</h1>
                <p>Unggah satu atau beberapa gambar (JPG, PNG, WebP) untuk digabungkan menjadi satu file PDF.</p>

                <form action="{{ route('user.tools.imageToPdf') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                    @csrf
                    <div class="form-control w-full max-w-md">
                        <label class="label" for="images">
                            <span class="label-text">Pilih Gambar:</span>
                        </label>
                        <input type="file" id="images" name="images[]" multiple required accept="image/*" class="file-input file-input-bordered file-input-primary w-full" />
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-4">Konversi ke PDF</button>
                </form>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-error shadow-lg mt-6">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </span>
                </div>
            </div>
        @endif

        @if (session('pdf_path'))
            <div class="card bg-base-100 shadow-xl mt-6">
                <div class="card-body">
                    <h2 class="card-title text-xl">PDF Anda Siap!</h2>
                    <p>Klik tombol di bawah untuk mengunduh file PDF Anda.</p>
                    <div class="card-actions justify-start mt-2">
                        <a href="{{ asset(session('pdf_path')) }}" class="btn btn-success" download>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection