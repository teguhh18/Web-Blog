@extends('user.new-layouts.main')
@section('main')
    <!-- Page Header -->
    <div class="bg-base-200 border-b border-base-300 py-12">
        <div class="container mx-auto px-4" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-8 h-8 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h1 class="text-4xl font-bold">Semua Artikel</h1>
            </div>
            <p class="text-base-content/60 text-lg">Koleksi lengkap artikel dari berbagai kategori dan penulis</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Articles Section (2/3 width) -->
            <div class="lg:col-span-2">
                @if ($dataBerita->isEmpty())
                    <x-empty-state message="Belum ada artikel tersedia." />
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
