@extends('user.new-layouts.main')
@section('main')
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
                        <h2 class="text-3xl font-bold">Search Results For : {{ $query }}</h2>
                    </div>
                </div>

                <!-- Regular Articles Grid -->
                <div class="grid md:grid-cols-3 gap-4">

                    @if ($dataBerita->isEmpty())
                        <p class="text-center text-base-content/70 col-span-3">Tidak ada artikel tersedia.</p>
                    @else
                        @foreach ($dataBerita as $berita)
                            <article class="card bg-base-100 shadow-lg glass-card" data-aos="fade-up" data-aos-delay="100">
                                <figure>
                                    <img src="{{ route('storage.show', ['path' => $berita->foto]) }}" alt="{{ $berita->title }}"
                                        class="w-full h-48 object-cover" />
                                </figure>
                                <div class="card-body">
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
                                                    <img src="{{ route('storage.show', ['path' => $berita->user->foto]) }}" alt="">
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
                <div class="mt-6">
                    {{ $dataBerita->links() }}
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
