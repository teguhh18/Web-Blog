@extends('user.new-layouts.main')
@section('main')
    <!-- Hero Section -->
    <div class="bg-neutral py-20">
        <div class="container mx-auto px-4 text-center" data-aos="fade-up">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 text-neutral-content">About Us</h1>
            <p class="text-lg md:text-xl text-neutral-content/70 max-w-2xl mx-auto">
                Discover our story, our mission, and the vision that drives us forward.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-16">
        <div class="container mx-auto px-4 max-w-6xl">

            <!-- Company History -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20" data-aos="fade-right">
                <div class="order-2 lg:order-1">
                    <span class="inline-block px-4 py-1 bg-primary/10 text-primary rounded-full text-sm font-semibold mb-4">
                        OUR STORY
                    </span>
                    <h2 class="text-4xl font-bold mb-6">Company History</h2>
                    <div class="space-y-4 text-base-content/70 leading-relaxed">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                            adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                            inventore? Voluptatum in tempora earum deleniti, culpa odit veniam.
                        </p>
                        <p>
                            Fugit eaque illum blanditiis, quo exercitationem maiores autem laudantium unde excepturi dolores
                            quasi eos vero harum ipsa quam laborum illo aut facere voluptates aliquam adipisci sapiente
                            beatae ullam temporibus aut!
                        </p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="{{ asset('user/img/post-landscape-2.jpg') }}"
                         class="w-full rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300"
                         alt="Company History"/>
                </div>
            </div>

            <!-- Mission & Vision -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20" data-aos="fade-left">
                <div>
                    <img src="{{ asset('user/img/post-landscape-1.jpg') }}"
                         class="w-full rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300"
                         alt="Mission and Vision"/>
                </div>
                <div>
                    <span class="inline-block px-4 py-1 bg-secondary/10 text-secondary rounded-full text-sm font-semibold mb-4">
                        OUR GOALS
                    </span>
                    <h2 class="text-4xl font-bold mb-6">Mission & Vision</h2>
                    <div class="space-y-4 text-base-content/70 leading-relaxed">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, perspiciatis repellat maxime,
                            adipisci non ipsam at itaque rerum vitae, necessitatibus nulla animi expedita cumque provident
                            inventore? Voluptatum in tempora earum deleniti, culpa odit veniam.
                        </p>
                        <p>
                            Fugit eaque illum blanditiis, quo exercitationem maiores autem laudantium unde excepturi dolores
                            quasi eos vero harum ipsa quam laborum illo aut facere voluptates aliquam adipisci sapiente
                            beatae ullam temporibus aut!
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Latest News CTA -->
    <section class="py-16 bg-base-200 border-y border-base-300">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center" data-aos="fade-up">
                <!-- Text Content -->
                <div>
                    <h2 class="text-4xl font-bold mb-6">Berita Terbaru</h2>
                    <p class="text-base-content/70 mb-4 leading-relaxed">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, rem eaque vel est asperiores iste
                        pariatur placeat molestias, rerum provident ea maiores debitis eum earum esse quas architecto!
                        Minima, voluptatum!
                    </p>
                    <p class="text-base-content/70 mb-8 leading-relaxed">
                        At magni dolore ullam odio sapiente ipsam, numquam eius minus animi inventore alias quam fugit
                        corrupti error iste laboriosam dolorum culpa doloremque eligendi repellat iusto vel impedit odit cum.
                    </p>
                    <a href="{{ route('user.berita') }}" class="btn btn-primary btn-lg gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Lihat Semua Berita
                    </a>
                </div>

                <!-- Image Gallery -->
                <div class="grid grid-cols-2 gap-4">
                    <img src="{{ asset('user/img/post-portrait-3.jpg') }}"
                         alt="Latest news photo 1"
                         class="rounded-2xl shadow-lg w-full h-auto hover:shadow-xl transition-shadow duration-300"/>
                    <img src="{{ asset('user/img/post-portrait-4.jpg') }}"
                         alt="Latest news photo 2"
                         class="rounded-2xl shadow-lg w-full h-auto mt-8 hover:shadow-xl transition-shadow duration-300"/>
                </div>
            </div>
        </div>
    </section>
@endsection
