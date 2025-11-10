@extends('admin.layouts.admin')

@section('main')
    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.berita.index') }}" class="btn btn-warning">
                <i class="bi bi-arrow-left-circle-fill"></i> Kembali
            </a>
        </div>
        <div class="card shadow-sm">
            @if ($dataBerita->foto == null)
                <img src="https://placehold.co/600x400?text=No+Image" alt="Foto Berita" width="100">
            @else
                <img class="card-img-top mt-2" src="{{ route('storage.show', ['path' => $dataBerita->foto]) }}" alt="{{ $dataBerita->title }}"
                    style="max-height: 450px; object-fit: contain; width: 100%;">
            @endif
            <div class="card-body p-4">
                <h1 class="card-title fw-bold">{{ $dataBerita->title }}</h1>
                <p class="card-subtitle mb-2 text-muted">
                    Dibuat pada: {{ $dataBerita->created_at->format('d F Y') }}
                </p>
                <hr>
                <div class="mt-4 fs-5">
                    {!! $dataBerita->berita !!}
                </div>
            </div>
        </div>
    </div>
@endsection
