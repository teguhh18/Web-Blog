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
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->title }}"
                                        class="w-full h-48 object-cover" />
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
                                                    <img src="{{ asset('storage/' . $berita->user->foto) }}" alt="">
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
                <!-- Popular Posts Widget -->
                <div class="card bg-base-100 shadow-lg glass-card" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Artikel Populer
                        </h3>
                        <div class="space-y-3">
                            @foreach ($beritaPopuler as $populer)
                                <article
                                    class="flex items-start space-x-3 p-3 rounded-lg bg-info/5 hover:bg-info/10 transition-colors">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <img src="{{ asset('storage/' . $populer->foto) }}" alt="{{ $populer->title }}">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-sm leading-tight">
                                            <a href="{{ route('user.berita.baca', $populer->slug) }}"
                                                class="hover:text-primary">{{ $populer->title }}</a>
                                        </h4>
                                        <div class="flex items-center text-xs text-base-content/60 mt-1">
                                            <span>{{ $populer->created_at->format('d M Y') }}</span>
                                            <span class="ms-2 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="size-5">
                                                    <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            <span>{{ $populer->views }} views</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="#" class="btn btn-outline btn-info btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card bg-base-100 shadow-lg glass-card" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Kategori
                        </h3>
                        <div class="space-y-2">
                            @forelse ($dataKategori as $kategori)
                                <a href="{{ route('user.berita.kategori', $kategori->slug) }}"
                                    class="flex justify-between items-center p-2 rounded-lg hover:bg-primary/10 transition-colors">
                                    <span class="flex items-center gap-3">
                                        <img src="{{ asset('storage/' . $kategori->foto) }}" alt="{{ $kategori->nama }}"
                                            class="w-6 h-6 rounded object-cover">
                                        <span>{{ $kategori->nama }}</span>
                                    </span>
                                    <div class="badge badge-primary badge-sm">{{ $kategori->berita_count }}</div>
                                </a>
                            @empty
                                <p class="text-center text-sm text-base-content/70 p-2">Tidak ada kategori.</p>
                            @endforelse
                        </div>
                        @if ($dataKategori->isNotEmpty())
                            <div class="mt-4 text-center">
                                <a href="#" class="btn btn-outline btn-sm">Lihat Semua Kategori</a>
                            </div>
                        @endif
                    </div>
                </div>



                <!-- Social Media Widget -->
                <div class="card bg-base-100 shadow-lg glass-card" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Terhubung dengan Kami
                        </h3>
                        <p class="text-sm text-base-content/60 mb-4">Ikuti kami di media sosial untuk update terbaru dan
                            konten eksklusif!</p>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="#" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-0">
                                📘 Facebook
                                <div class="badge badge-ghost badge-sm">25K</div>
                            </a>
                            <a href="#" class="btn btn-sm bg-sky-500 hover:bg-sky-600 text-white border-0">
                                🐦 Twitter
                                <div class="badge badge-ghost badge-sm">15K</div>
                            </a>
                            <a href="#" class="btn btn-sm bg-pink-600 hover:bg-pink-700 text-white border-0">
                                📷 Instagram
                                <div class="badge badge-ghost badge-sm">18K</div>
                            </a>
                            <a href="#" class="btn btn-sm bg-gray-800 hover:bg-gray-900 text-white border-0">
                                💻 GitHub
                                <div class="badge badge-ghost badge-sm">5K</div>
                            </a>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
    </div>
@endsection
