@extends('user.new-layouts.main')
@section('main')
    <!-- Hero Section -->
    <div class="hero min-h-96 hero-gradient">
        <div class="hero-overlay bg-opacity-20"></div>
        <div class="hero-content text-neutral-content text-center" data-aos="fade-show">
            <div class="max-w-md">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-16 h-16 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h1 class="text-5xl font-bold">Web Blog</h1>
                </div>
                <p class="py-6">Template blog modern dengan DaisyUI dan Tailwind CSS. Responsif, elegan, dan mudah
                    dikustomisasi.</p>
                <div class="flex flex-wrap justify-center gap-2">
                    <div class="badge badge-outline badge-lg">HTML5 Semantik</div>
                    <div class="badge badge-outline badge-lg">DaisyUI</div>
                    <div class="badge badge-outline badge-lg">Tailwind CSS</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Articles Section (2/3 width) -->
            <div class="lg:col-span-2">
                <!-- Section Header -->
                <div class="mb-8" data-aos="fade-show">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 mr-3 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-4xl font-bold">Artikel Terbaru</h2>
                    </div>
                    <p class="text-base-content/70 text-lg">Temukan artikel-artikel terbaru seputar teknologi, programming,
                        dan pengembangan web</p>
                </div>

                <!-- Regular Articles Grid -->
                <div class="grid md:grid-cols-3 gap-4">

                    @if ($dataBerita->isEmpty())
                        <p class="text-center text-base-content/70 col-span-3">Tidak ada artikel tersedia.</p>
                    @else
                        @foreach ($dataBerita as $berita)
                            <article class="card bg-base-100 shadow-lg glass-card" data-aos="fade-up" data-aos-delay="100">
                                <figure>
                                    <img src="{{ route('storage.show', ['path' => $berita->foto]) }}"
                                        alt="{{ $berita->title }}" class="w-full h-48 object-cover" />
                                </figure>
                                <div class="card-body">
                                    {{-- <div class="flex flex-wrap gap-1 mb-2">
                                        <div class="badge badge-success badge-sm">vue.js</div>
                                        <div class="badge badge-outline badge-sm">frontend</div>
                                    </div> --}}
                                    <h3 class="card-title text-lg">
                                        <a href="{{ route('user.berita.baca', $berita->slug) }}"
                                            class="link link-hover">{{ $berita->title }}</a>
                                    </h3>
                                    <p class="text-sm text-base-content/70 mb-3">
                                        {{ Str::limit(strip_tags($berita->berita), 100, '...') }}
                                    </p>
                                    <div class="flex justify-between items-center text-xs text-base-content/60">
                                        <div class="flex items-center gap-1">
                                            <div class="avatar placeholder">
                                                <div class="bg-primary text-primary-content rounded-full w-6">
                                                    <img src="{{ route('storage.show', ['path' => $berita->user->foto]) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                            <span>{{ $berita->user->name }}</span>
                                        </div>
                                        <time>{{ $berita->created_at->format('d M Y') }}</time>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>

                {{-- <!-- Load More Button -->
                <div class="text-center mt-8" data-aos="fade-up" data-aos-delay="100">
                    <button class="btn btn-outline btn-primary btn-wide">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Muat Artikel Lainnya
                    </button>
                </div> --}}
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
