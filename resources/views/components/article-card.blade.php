@props(['article', 'delay' => 100])

<article class="group card bg-base-100 shadow-md hover:shadow-xl transition-all duration-300 border border-base-200" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <figure class="relative overflow-hidden">
        <img src="{{ route('storage.show', ['path' => $article->foto]) }}"
            alt="{{ $article->title }}"
            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500" />
        @if($article->kategori)
            <div class="absolute top-3 left-3">
                <span class="badge badge-primary badge-sm shadow-lg">
                    {{ $article->kategori->nama }}
                </span>
            </div>
        @endif
    </figure>
    <div class="card-body p-5">
        <h3 class="card-title text-lg font-semibold line-clamp-2 mb-2">
            <a href="{{ route('user.berita.baca', $article->slug) }}"
                class="link link-hover group-hover:text-primary transition-colors">
                {{ $article->title }}
            </a>
        </h3>
        <p class="text-sm text-base-content/70 line-clamp-3 mb-4">
            {{ Str::limit(strip_tags($article->berita), 120, '...') }}
        </p>
        <div class="flex justify-between items-center text-xs text-base-content/60 mt-auto">
            <div class="flex items-center gap-2">
                <div class="avatar">
                    <div class="w-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        @if ($article->user && $article->user->foto)
                            <img src="{{ route('storage.show', ['path' => $article->user->foto]) }}"
                                alt="{{ $article->user->name }}">
                        @else
                            <div class="bg-primary text-primary-content flex items-center justify-center h-full">
                                <span class="text-xs font-bold">{{ strtoupper(substr($article->user->name ?? 'U', 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <span class="font-medium">{{ $article->user->name ?? 'Unknown' }}</span>
            </div>
            <time class="flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                {{ $article->created_at->format('d M Y') }}
            </time>
        </div>
    </div>
</article>
