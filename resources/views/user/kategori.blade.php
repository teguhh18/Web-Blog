@extends('user.layouts.main')
@section('main')
<main id="main">
    <section>
      <div class="container">
        <div class="row">

          <div class="col-md-9" data-aos="fade-up">
            <h3 class="category-title">Kategori: {{ $title }}</h3>

            @foreach($dataBerita as $berita)
            <div class="d-md-flex post-entry-2 half">
              <a href="{{ route('user.berita.baca', $berita->slug) }}" class="me-4 thumbnail">
                <img src="{{ asset('storage/' . $berita->foto) }}" alt="" class="img-fluid img-thumbnail" style="height: 300px; width:500px">
              </a>
              <div>
                <div class="post-meta">
                  <span class="date">{{ $berita->kategori->nama }}</span> 
                  <span class="mx-1">&bullet;</span> 
                  <span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                  <span class="mx-1">&bullet;</span>
                  <span><i class="bi bi-eye"></i> {{ $berita->views }}</span>
              </div>
                <h3><a href="{{ route('user.berita.baca', $berita->slug) }}">{{ $berita->title }}</a></h3>
                <p></p>
                <div class="d-flex align-items-center author">
                  <div class="photo">
                    @if($berita->user->foto)
                    <img src="{{ asset('storage/' . $berita->user->foto) }}" alt="" class="img-fluid img-thumbnail"></div>
                    @else
                    @endif
                    <img src="{{ asset ('user/img/person-2.jpg') }}" alt="" class="img-fluid img-thumbnail"></div>
                  <div class="name">
                    <p class="m-0 p-0">By. {{ $berita->user->name }}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <div class="text-start py-4">
                          
              {{ $dataBerita->links() }}
            
          </div>
          </div>

          <div class="col-md-3">
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
                @foreach($Berita as $brt)
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
                    <span class="author mb-3 d-block text-capitalize">{{ $brt->user->name }}</span>
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
                    ><i class="bi bi-chevron-right " ></i><span class="text-capitalize"> {{ $kategori->nama }}</span></a
                  >
                </li>
                @endforeach
              </ul>
            </div>
            <!-- End Categories -->

            
          </div>

        </div>
      </div>
    </section>
  </main><!-- End #main -->
@endsection