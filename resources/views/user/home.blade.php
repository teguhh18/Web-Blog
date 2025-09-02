@extends('user.layouts.main')
@section('main')
    <main id="main">
        @if ($dataBerita->isEmpty())
            <section id="hero-slider" class="hero-slider">
                <div class="container-md" data-aos="fade-in">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper sliderFeaturedPosts">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="#" class="img-bg d-flex align-items-end"
                                            style="background-image: url('https://placehold.co/600x400?text=No+Image');">
                                            <div class="img-bg-inner">
                                                <h2>No Data</h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <!-- ======= Hero Slider Section ======= -->
            <section id="hero-slider" class="hero-slider">
                <div class="container-md" data-aos="fade-in">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper sliderFeaturedPosts">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="{{ route('user.berita.baca', $dataBerita[0]->slug) }}"
                                            class="img-bg d-flex align-items-end"
                                            style="background-image: url('{{ asset('storage/' . $dataBerita[0]->foto) }}');">
                                            <div class="img-bg-inner">
                                                <h2>{{ $dataBerita[0]->title }}</h2>
                                                {{-- <div>{!! Str::limit($dataBerita[0]->berita, 100, '...') !!}</div> --}}
                                                {{-- <p>{{ $dataBerita[0]->user->name }}</p> --}}
                                            </div>
                                        </a>
                                    </div>

                                    <div class="swiper-slide">
                                        <a href="{{ route('user.berita.baca', $dataBerita[1]->slug) }}"
                                            class="img-bg d-flex align-items-end"
                                            style="background-image: url('{{ asset('storage/' . $dataBerita[1]->foto) }}');">
                                            <div class="img-bg-inner">
                                                <h2>{{ $dataBerita[1]->title }}</h2>
                                                {{-- <div>{!! Str::limit($dataBerita[0]->berita, 100, '...') !!}</div> --}}
                                                {{-- <p>{{ $dataBerita[0]->user->name }}</p> --}}
                                            </div>
                                        </a>
                                    </div>

                                    <div class="swiper-slide">
                                        <a href="{{ route('user.berita.baca', $dataBerita[2]->slug) }}"
                                            class="img-bg d-flex align-items-end"
                                            style="background-image: url('{{ asset('storage/' . $dataBerita[2]->foto) }}');">
                                            <div class="img-bg-inner">
                                                <h2>{{ $dataBerita[2]->title }}</h2>
                                                {{-- <div>{!! Str::limit($dataBerita[0]->berita, 100, '...') !!}</div> --}}
                                                {{-- <p>{{ $dataBerita[0]->user->name }}</p> --}}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="custom-swiper-button-next">
                                    <span class="bi-chevron-right"></span>
                                </div>
                                <div class="custom-swiper-button-prev">
                                    <span class="bi-chevron-left"></span>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- End Hero Slider Section -->
        @endif


        <!-- ======= Post Grid Section ======= -->
        <section id="posts" class="posts">
            <div class="container" data-aos="fade-up">
                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h2>Berita Terbaru</h2>
                    <div><a href="{{ route('user.berita') }}" class="more">Lihat Semua Berita</a></div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-9">
                        <div class="row d-flex flex-wrap">
                            @if ($dataBerita->isEmpty())
                                <p class="text-center">Tidak ada berita terbaru.</p>
                            @else
                                @foreach ($dataBerita as $berita)
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="post-entry-1">
                                            <a href="{{ route('user.berita.baca', $berita->slug) }}"><img
                                                    src="{{ asset('storage/' . $berita->foto) }}" alt=""
                                                    class="img-fluid img-thumbnail" style="height: 250px; width:350px"></a>
                                            <div class="post-meta">
                                                <span class="date">{{ $berita->kategori->nama }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span><i class="bi bi-eye"></i> {{ $berita->views }}</span>
                                            </div>
                                            <h2><a
                                                    href="{{ route('user.berita.baca', $berita->slug) }}">{{ $berita->title }}</a>
                                            </h2>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Trending Section -->
                    <div class="col-lg-3">
                        <div class="aside-block">
                            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-latest" type="button" role="tab"
                                        aria-controls="pills-latest" aria-selected="false">
                                        Berita Populer
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <!-- Popular -->
                                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                                    aria-labelledby="pills-popular-tab">

                                    @foreach ($beritaPopuler as $populer)
                                        <div class="post-entry-1 border-bottom">
                                            <div class="post-meta">
                                                <span class="date">{{ $populer->kategori->nama }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span>{{ \Carbon\Carbon::parse($populer->created_at)->translatedFormat('d F Y') }}</span>
                                            </div>
                                            <h2 class="mb-2">
                                                <a
                                                    href="{{ route('user.berita.baca', $populer->slug) }}">{{ $populer->title }}</a>
                                            </h2>
                                            <span class="author mb-3 d-block">{{ $populer->user->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- End Popular -->
                            </div>
                        </div>


                        <div class="trending">
                            <h3>Kategori</h3>
                            <ul class="trending-post">
                                @foreach ($dataKategori as $kategori)
                                    <li>
                                        <a href="{{ route('user.berita.kategori', $kategori->slug) }}">
                                            {{-- <span class="number">{{ $loop->iteration }}</span> --}}
                                            <h3 class="text-capitalize"><i
                                                    class="bi bi-chevron-right"></i>{{ $kategori->nama }}</h3>
                                            {{-- <span class="author">Cameron Williamson</span> --}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div> <!-- End Trending Section -->

                </div> <!-- End .row -->
            </div>
        </section> <!-- End Post Grid Section -->



    </main><!-- End #main -->
@endsection
