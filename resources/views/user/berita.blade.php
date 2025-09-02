@extends('user.layouts.main')
@section('main')
    <main id="main">
        <!-- ======= Post Grid Section ======= -->
        <section id="posts" class="posts">
            <div class="container" data-aos="fade-up">
                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h3>Semua Berita</h3>
                    {{-- <div><a href="category.html" class="more">Lihat Semua Berita</a></div> --}}
                </div>
                <div class="row g-5">
                    <div class="col-lg-10">
                        <div class="row d-flex flex-wrap">
                            @if ($dataBerita->isEmpty())
                                <p class="text-center">Tidak ada berita terbaru.</p>
                            @else
                             @foreach($dataBerita as $berita)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="post-entry-1">
                                    <a href="{{ route('user.berita.baca', $berita->slug) }}"><img src="{{ asset('storage/' . $berita->foto) }}"
                                            alt="" class="img-fluid img-thumbnail" style="height: 250px; width:350px"></a>
                                    <div class="post-meta">
                                        <span class="date">{{ $berita->kategori->nama }}</span> 
                                        <span class="mx-1">&bullet;</span> 
                                        <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                                        <span class="mx-1">&bullet;</span>
                                        <span><i class="bi bi-eye"></i> {{ $berita->views }}</span>
                                    </div>
                                    <h2><a href="{{ route('user.berita.baca', $berita->slug) }}">{{ $berita->title }}</a></h2>
                                </div>
                            </div>
                            @endforeach
                            @endif
                           
                        </div>
                        <div class="text-start py-4">
                            {{ $dataBerita->links() }}
                        </div>
                    </div>
                    <!-- Trending Section -->
                    <div class="col-lg-2">
                        <div class="trending">
                            <h3>Kategori</h3>
                            <ul class="trending-post">
                                @foreach($dataKategori as $kategori)
                                <li>
                                    <a href="{{ route('user.berita.kategori', $kategori->slug) }}">
                                        <h3 class="text-capitalize">{{ $kategori->nama }}</h3>
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
