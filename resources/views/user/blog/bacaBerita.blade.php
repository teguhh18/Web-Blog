@extends('user.new-layouts.main')
@section('main')
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Article Content (3/4 width) -->
            <article class="lg:col-span-3">
                <!-- Article Header -->
                <header class="mb-8 mt-2" data-aos="fade-up">
                    <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                        {{ $berita->title }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-6 text-base-content/60 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="avatar">
                                <div class="w-10 rounded-full">
                                    <img src="{{ route('storage.show', ['path' => $berita->user->foto]) }}"
                                        alt="{{ $berita->user->name }}" />
                                </div>
                            </div>
                            <div>
                                <div class="font-medium text-base-content">{{ $berita->user->name }}</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-sm">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $berita->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $berita->views }} views</span>
                            </div>

                        </div>
                    </div>

                    <!-- Social Share Buttons -->
                    <div class="flex flex-wrap gap-2">
                        <button class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Share
                        </button>
                        <button class="btn btn-sm bg-sky-500 hover:bg-sky-600 text-white border-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                            Tweet
                        </button>
                        <button class="btn btn-sm bg-blue-700 hover:bg-blue-800 text-white border-0">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                            Share
                        </button>
                        <button class="btn btn-sm btn-outline" id="copy-link-btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Copy Link
                        </button>
                    </div>
                </header>

                <!-- Featured Image -->
                <figure class="mb-8 flex justify-center" data-aos="fade-up" data-aos-delay="200">
                    <img class="w-full h-auto max-h-[500px] object-contain rounded-lg"
                        src="{{ route('storage.show', ['path' => $berita->foto]) }}" alt="{{ $berita->title }}" />
                </figure>

                <!-- Article Content -->
                <div class="article-content prose max-w-none dark" data-aos="fade-up" data-aos-delay="300">
                    {!! $berita->berita !!}
                </div>

                @include('user.blog.partials.comment')
            </article>

            <!-- Sidebar (1/4 width) -->
            <aside class="space-y-6">
                @include('user.blog.partials.related')
            </aside>
        </div>
    </div>

    @push('js')
        @if (session('msg'))
            <script>
                Swal.fire({
                    icon: '{{ session('icon') }}',
                    title: '{{ session('msg') }}',
                    showConfirmButton: false,
                    timer: 1000
                })
            </script>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const copyButton = document.getElementById('copy-link-btn');
                if (copyButton) {
                    copyButton.addEventListener('click', function() {

                        navigator.clipboard.writeText(window.location.href).then(function() {

                            const toast = document.createElement('div');
                            toast.className = 'toast toast-top toast-end';
                            toast.innerHTML = `
                        <div class="alert alert-success">
                            <span>Link berhasil disalin!</span>
                        </div>
                    `;
                            document.body.appendChild(toast);
                            setTimeout(() => {
                                document.body.removeChild(toast);
                            }, 3000);
                        });
                    });
                }
            });
        </script>
    @endpush
@endsection
