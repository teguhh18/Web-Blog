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
                            <div class="border-top border-bottom py-3 my-4">
                                <h5 class="mb-3">Bagikan Artikel Ini:</h5>
                                <div class="d-flex align-items-center">
                                    @php
                                        $currentUrl = url()->current();
                                        $shareText = 'Baca artikel menarik: ' . $berita->title;
                                    @endphp
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($currentUrl) }}"
                                        target="_blank" class="btn btn-primary btn-sm me-2"
                                        style="background-color: #3b5998;" title="Bagikan ke Facebook">
                                        <i class="bi bi-facebook"></i> Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode($currentUrl) }}&text={{ urlencode($shareText) }}"
                                        target="_blank" class="btn btn-info btn-sm me-2 text-white"
                                        style="background-color: #00acee;" title="Bagikan ke Twitter">
                                        <i class="bi bi-twitter"></i> Twitter
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($shareText . ' ' . $currentUrl) }}"
                                        target="_blank" class="btn btn-success btn-sm me-2"
                                        style="background-color: #25D366;" title="Bagikan ke WhatsApp">
                                        <i class="bi bi-whatsapp"></i> WhatsApp
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode($currentUrl) }}&title={{ urlencode($berita->title) }}"
                                        target="_blank" class="btn btn-primary btn-sm me-2"
                                        style="background-color: #0e76a8;" title="Bagikan ke LinkedIn">
                                        <i class="bi bi-linkedin"></i> LinkedIn
                                    </a>
                                    <button id="copy-link-btn" class="btn btn-secondary btn-sm" title="Salin Tautan">
                                        <i class="bi bi-link-45deg"></i> Salin Link
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Post Content -->

                        <!-- ======= Comments ======= -->
                        <div class="comments">
                            <h5 class="comment-title py-4">{{ $countComment }} Komentar</h5>
                            @foreach ($dataComment as $comments)
                                <div class="comment d-flex mb-4">
                                    <div class="flex-shrink-0">
                                        <div class="avatar avatar-sm rounded-circle">
                                            @if ($comments->user->foto)
                                                <img class="avatar-img"
                                                    src="{{ asset('storage/' . $comments->user->foto) }}" alt=""
                                                    class="img-fluid" />
                                            @else
                                                <img class="avatar-img" src="{{ asset('user/img/person-1.jpg') }}"
                                                    alt="" class="img-fluid" />
                                            @endif
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
                                            <textarea class="form-control" id="comment" name="comment" placeholder="Masukkan Komentar" cols="30"
                                                rows="10"></textarea>
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
                            <h3 class="aside-title">Artikel Terkait</h3>
                            <div class="tab-content" id="pills-tabContent">
                                <!-- Popular -->
                                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                                    aria-labelledby="pills-popular-tab">
                                    @foreach ($relateds as $related)
                                        <div class="post-entry-1 border-bottom">
                                            <div class="post-meta">
                                                <span class="date">{{ $related->kategori->nama }}</span>
                                                <span class="mx-1">&bullet;</span>
                                                <span>{{ \Carbon\Carbon::parse($related->created_at)->translatedFormat('d F Y') }}</span>
                                            </div>
                                            <h2 class="mb-2">
                                                <a
                                                    href="{{ route('user.berita.baca', $related->slug) }}">{{ $related->title }}</a>
                                            </h2>
                                            <span class="author mb-3 d-block">{{ $related->user->name }}</span>
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

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const copyButton = document.getElementById('copy-link-btn');
                copyButton.addEventListener('click', function() {
                    const url = "{{ $currentUrl }}";
                    navigator.clipboard.writeText(url).then(function() {
                        swal.fire({
                            icon: 'success',
                            title: 'Tautan disalin ke clipboard!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }, function(err) {
                        swal.fire({
                            icon: 'error',
                            title: 'Gagal menyalin tautan',
                            text: err,
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
