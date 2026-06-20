@extends('user.new-layouts.main')
@section('main')
    <!-- Hero Section -->
    <div class="hero min-h-[400px] bg-neutral relative overflow-hidden">
        <div class="hero-content text-neutral-content text-center relative z-10" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-16 h-16 bg-neutral-content/10 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-4">Web Blog</h1>
                <p class="text-lg md:text-xl mb-6 text-neutral-content/80">
                    Temukan artikel menarik seputar teknologi, programming, dan pengembangan web
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('user.berita') }}" class="btn btn-primary btn-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Baca Artikel
                    </a>
                    <a href="{{ route('user.about') }}" class="btn btn-ghost btn-lg text-neutral-content hover:bg-neutral-content/10">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8" data-aos="fade-up">
            <div>
                <h2 class="text-3xl font-bold flex items-center gap-3">
                    <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Artikel Terbaru
                </h2>
                <p class="text-base-content/60 mt-2">Jelajahi artikel-artikel terbaru dari para penulis kami</p>
            </div>
            <a href="{{ route('user.berita') }}" class="btn btn-outline btn-primary hidden sm:flex">
                Lihat Semua
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Articles Section (2/3 width) -->
            <div class="lg:col-span-2">
                @if ($dataBerita->isEmpty())
                    <x-empty-state message="Belum ada artikel tersedia saat ini." />
                @else
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach ($dataBerita as $index => $berita)
                            <x-article-card :article="$berita" :delay="$index * 100" />
                        @endforeach
                    </div>

                    @if($dataBerita->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $dataBerita->links() }}
                        </div>
                    @endif
                @endif

                <div class="mt-8 text-center sm:hidden">
                    <a href="{{ route('user.berita') }}" class="btn btn-outline btn-primary btn-wide">
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>

            <!-- Sidebar (1/3 width) -->
            <aside class="space-y-6">
                @include('user.blog.partials.populer')
                @include('user.blog.partials.kategori')
                @include('user.blog.partials.sosial-media')
            </aside>
        </div>
    </div>
@endsection
