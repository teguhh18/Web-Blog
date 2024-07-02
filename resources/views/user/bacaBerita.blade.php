@extends('user.layouts.main')
@section('main')
    <main id="main">
        <section class="single-post-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 post-content" data-aos="fade-up">
                        <!-- ======= Single Post Content ======= -->
                        <div class="single-post">
                            <div class="post-meta">
                                <span class="date">{{ $berita->kategori->nama }}</span>
                                <span
                                    class="mx-1">&bullet;</span><span>{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span>
                                <span class="mx-1">&bullet;</span><span>By.{{ $berita->user->name }}</span>
                            </div>
                            <h1 class="mb-5">
                                {{ $berita->title }}
                            </h1>

                            <div class="my-3">
                                <img {{-- src="{{ asset ('user/img/post-landscape-1.jpg') }}" --}} src="{{ asset('storage/' . $berita->foto) }}" alt=""
                                    class="img-fluid" />

                            </div>
                            <div>
                                {!! $berita->berita !!}
                            </div>

                        </div>
                        <!-- End Single Post Content -->

                        <!-- ======= Comments ======= -->
                        <div class="comments">
                            <h5 class="comment-title py-4">{{ $countComment }} Komentar</h5>
                            @foreach($dataComment as $comments)
                            <div class="comment d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm rounded-circle">
                                        <img class="avatar-img" src="assets/img/person-5.jpg" alt=""
                                            class="img-fluid" />
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-2 ms-sm-3">
                                    <div class="comment-meta d-flex align-items-baseline">
                                        <h6 class="me-2">{{ $comments->user->name }}</h6>
                                        <span class="text-muted">{{ $comments->created_at }}</span>
                                    </div>
                                    <div class="comment-body">
                                      {{ $comments->comment }}
                                    </div>

                                    {{-- <div class="comment-replies bg-light p-3 mt-3 rounded">
                                        <h6 class="comment-replies-title mb-4 text-muted text-uppercase">
                                            2 replies
                                        </h6>

                                        <div class="reply d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm rounded-circle">
                                                    <img class="avatar-img" src="assets/img/person-4.jpg" alt=""
                                                        class="img-fluid" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                <div class="reply-meta d-flex align-items-baseline">
                                                    <h6 class="mb-0 me-2">Brandon Smith</h6>
                                                    <span class="text-muted">2d</span>
                                                </div>
                                                <div class="reply-body">
                                                    Lorem ipsum dolor sit, amet consectetur adipisicing
                                                    elit.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-sm rounded-circle">
                                                    <img class="avatar-img" src="assets/img/person-3.jpg" alt=""
                                                        class="img-fluid" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 ms-sm-3">
                                                <div class="reply-meta d-flex align-items-baseline">
                                                    <h6 class="mb-0 me-2">James Parsons</h6>
                                                    <span class="text-muted">1d</span>
                                                </div>
                                                <div class="reply-body">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing
                                                    elit. Distinctio dolore sed eos sapiente,
                                                    praesentium.
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                              </div>
                              @endforeach
                            
                        </div>
                        <!-- End Comments -->

                        <!-- ======= Comments Form ======= -->
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-12">
                                <h5 class="comment-title">Leave a Comment</h5>
                                <div class="row">
                                  <form action="{{ route('user.comment.store', $berita->slug) }}" method="POST">
                                    @csrf
                                    <div class="col-12 mb-3">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" placeholder="Masukkan Komentar" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                                    </div>
                                </form>
                                
                                </div>
                            </div>
                        </div>
                        <!-- End Comments Form -->
                    </div>
                    <div class="col-md-3 mt-3">
                        <!-- ======= Sidebar ======= -->
                        <div class="aside-block">
                            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-latest" type="button" role="tab"
                                        aria-controls="pills-latest" aria-selected="false">
                                        Berita Terbaru
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <!-- Popular -->
                                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                                    aria-labelledby="pills-popular-tab">
                                    @foreach ($dataBerita as $brt)
                                        <div class="post-entry-1 border-bottom">
                                            <div class="post-meta">
                                                <span class="date">{{ $brt->kategori->nama }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span>{{ \Carbon\Carbon::parse($brt->created_at)->translatedFormat('d F Y') }}</span>
                                            </div>
                                            <h2 class="mb-2">
                                                <a
                                                    href="{{ route('user.berita.baca', $brt->slug) }}">{{ $brt->title }}</a>
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
                                @foreach ($dataKategori as $kategori)
                                    <li>
                                        <a href="{{ route('user.berita.kategori', $kategori->slug) }}"><span
                                                class="text-capitalize"><i class="bi bi-chevron-right"></i>
                                                {{ $kategori->nama }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Categories -->

                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->
@endsection
