                <!-- Related Posts -->
                <div class="card bg-base-100 shadow-lg glass-card" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Artikel Terkait
                        </h3>
                        <div class="space-y-4">
                            @foreach ($relateds as $related)
                                <article class="flex gap-3">
                                    <img src="{{ route('storage.show', ['path' => $related->foto]) }}"
                                        alt="{{ $related->title }}"
                                        class="w-20 h-15 object-cover rounded flex-shrink-0" />
                                    <div class="flex-1">
                                        <h4 class="font-medium text-sm leading-tight mb-1">
                                            <a href="{{ route('user.berita.baca', $related->slug) }}"
                                                class="link link-hover">{{ $related->title }}</a>
                                        </h4>
                                        <div class="text-xs text-base-content/60">
                                            {{ $related->created_at->format('d M Y') }}</div>
                                    </div>
                                </article>
                            @endforeach

                        </div>
                        <div class="mt-4">
                            <a href="{{ route('user.berita') }}" class="btn btn-outline btn-sm btn-block">Lihat Artikel
                                Lainnya</a>
                        </div>
                    </div>
                </div>
