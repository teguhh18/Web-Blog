@extends('user.layouts.main')
@section('main')
    <main id="main">

        <!-- ======= Post Grid Section ======= -->
        <section id="posts" class="posts">
            <div class="container" data-aos="fade-up">
                <div class="section-header d-flex justify-content-between align-items-center mb-5">
                    <h3>List Kategori</h3>
                    {{-- <div><a href="category.html" class="more">Lihat Semua Berita</a></div> --}}
                </div>
                <div class="row g-5">
                    <div class="col-lg-9">
                        <div class="row d-flex flex-wrap">
                            @foreach($dataKategori as $kategori)
                            
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="post-entry-1">
                                    <a href="{{ route('user.berita.kategori', $kategori->slug) }}"><img src="{{ asset('storage/' . $kategori->foto) }}"
                                            alt="" class="img-fluid"></a>
                                    {{-- <div class="post-meta"><span class="date">{{ $kategori->nama }}</span> <span
                                            class="mx-1">&bullet;</span> <span>{{ \Carbon\Carbon::parse($kategori->created_at)->translatedFormat('d F Y') }}</span></div> --}}
                                    <h2 class="text-capitalize"><a href="{{ route('user.berita.kategori', $kategori->slug) }}">{{ $kategori->nama }}</a></h2>
                                </div>
                            </div>
                            
                            @endforeach
                            
                        </div>
                        <div class="text-start py-4">
                          
                            {{ $dataKategori->links() }}
                          
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <!-- ======= Sidebar ======= -->
                        <div class="aside-block">
                          <ul
                            class="nav nav-pills custom-tab-nav mb-4"
                            id="pills-tab"
                            role="tablist"
                          >
            
                            <li class="nav-item" role="presentation">
                              <button
                                class="nav-link"
                                id="pills-latest-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#pills-latest"
                                type="button"
                                role="tab"
                                aria-controls="pills-latest"
                                aria-selected="false"
                              >
                                Berita Terbaru
                              </button>
                            </li>
                          </ul>
            
                          <div class="tab-content" id="pills-tabContent">
                            <!-- Popular -->
                            <div
                              class="tab-pane fade show active"
                              id="pills-popular"
                              role="tabpanel"
                              aria-labelledby="pills-popular-tab"
                            >
                            @foreach($dataBerita as $brt)
                              <div class="post-entry-1 border-bottom">
                                <div class="post-meta">
                                  <span class="date">{{ $brt->kategori->nama }}</span>
                                  <span class="mx-1">&bullet;</span>
                                  <span>{{ \Carbon\Carbon::parse($brt->created_at)->translatedFormat('d F Y') }}</span>
                                </div>
                                <h2 class="mb-2">
                                  <a href="{{ route('user.berita.baca', $brt->slug) }}"
                                    >{{ $brt->title }}</a
                                  >
                                </h2>
                                <span class="author mb-3 d-block">{{ $brt->user->name }}</span>
                              </div>
                              @endforeach
                            </div>
                            <!-- End Popular -->
            
                            
            
                            
                          </div>
                        </div>
            
                       
            
                        <div class="aside-block">
                          <h3 class="aside-title">Kategori</h3>
                          <ul class="aside-links list-unstyled">
                            @foreach($dataKategori as $kategori)
                            <li>
                              <a href="{{ route('user.berita.kategori', $kategori->slug) }}"
                                ><span class="text-capitalize"><i class="bi bi-chevron-right"></i> {{ $kategori->nama }}</span></a
                              >
                            </li>
                            @endforeach
                          </ul>
                        </div>
                        <!-- End Categories -->
                        
                      </div>
            
                    

                </div> <!-- End .row -->
            </div>
        </section>
         <!-- End Post Grid Section -->

         
        

    </main><!-- End #main -->
@endsection
