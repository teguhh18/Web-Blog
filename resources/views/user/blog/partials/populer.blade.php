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
                                        <img src="{{ route('storage.show', ['path' => $populer->foto]) }}"
                                            alt="{{ $populer->title }}">
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