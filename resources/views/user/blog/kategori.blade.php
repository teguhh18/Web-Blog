@extends('user.new-layouts.main')
@section('main')
    <!-- Page Header -->
    <div class="bg-base-200 border-b border-base-300 py-12">
        <div class="container mx-auto px-4" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                </svg>
                <h1 class="text-4xl font-bold">Kategori: {{ $title }}</h1>
            </div>
            <p class="text-base-content/60 text-lg">Artikel-artikel dalam kategori {{ $title }}</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Articles Section (2/3 width) -->
            <div class="lg:col-span-2">
                @if ($dataBerita->isEmpty())
                    <x-empty-state message="Belum ada artikel dalam kategori ini." />
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
