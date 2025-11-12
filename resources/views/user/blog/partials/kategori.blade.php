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
                        @if ($kategori->foto)
                            <img src="{{ route('storage.show', ['path' => $kategori->foto]) }}"
                                alt="{{ $kategori->nama }}" class="w-6 h-6 rounded object-cover">
                        @else
                            <div class="w-6 h-6 bg-base-200 rounded flex items-center justify-center">
                                <svg class="w-4 h-4 text-base-content/50" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4V5h12v10zM8.5 7a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm5.25 1.75l-3.5 4.5-2-2.5L6 13h8.75a.25.25 0 00.25-.25v-3.5a.25.25 0 00-.25-.25z" />
                                </svg>
                            </div>
                        @endif

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
