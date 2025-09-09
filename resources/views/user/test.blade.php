@extends('user.new-layouts.main')
@section('main')
    <!-- Hero Section -->
    <div class="hero min-h-96 hero-gradient">
        <div class="hero-overlay bg-opacity-20"></div>
        <div class="hero-content text-neutral-content text-center" data-aos="fade-show">
            <div class="max-w-md">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-16 h-16 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h1 class="text-5xl font-bold">ModernBlog</h1>
                </div>
                <p class="py-6">Template blog modern dengan DaisyUI dan Tailwind CSS. Responsif, elegan, dan mudah
                    dikustomisasi.</p>
                <div class="flex flex-wrap justify-center gap-2">
                    <div class="badge badge-outline badge-lg">HTML5 Semantik</div>
                    <div class="badge badge-outline badge-lg">DaisyUI</div>
                    <div class="badge badge-outline badge-lg">Tailwind CSS</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Articles Section (2/3 width) -->
            <div class="lg:col-span-2">
                <!-- Section Header -->
                <div class="mb-8" data-aos="fade-show">
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 mr-3 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h2 class="text-4xl font-bold">Artikel Terbaru</h2>
                    </div>
                    <p class="text-base-content/70 text-lg">Temukan artikel-artikel terbaru seputar teknologi, programming,
                        dan pengembangan web</p>
                </div>

                <!-- Regular Articles Grid -->
                <div class="grid md:grid-cols-3 gap-4">
                    <!-- Article 1 -->
                    <article class="card bg-base-100 shadow-lg glass-card" data-aos="fade-up" data-aos-delay="100">
                        <figure>
                            <img src="https://placehold.co/400x200/764ba2/ffffff?text=Vue.js+3" alt="Vue.js 3"
                                class="w-full h-48 object-cover" />
                        </figure>
                        <div class="card-body">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <div class="badge badge-success badge-sm">vue.js</div>
                                <div class="badge badge-outline badge-sm">frontend</div>
                            </div>
                            <h3 class="card-title text-lg">
                                <a href="#" class="link link-hover">Vue.js 3 Composition API: Panduan Praktis</a>
                            </h3>
                            <p class="text-sm text-base-content/70 mb-3">
                                Pelajari Composition API di Vue.js 3 dan bagaimana menggunakannya untuk membuat komponen
                                yang lebih modular.
                            </p>
                            <div class="flex justify-between items-center text-xs text-base-content/60">
                                <div class="flex items-center gap-1">
                                    <div class="avatar placeholder">
                                        <div class="bg-primary text-primary-content rounded-full w-6">
                                            <span class="text-xs">AD</span>
                                        </div>
                                    </div>
                                    <span>Alex Dev</span>
                                </div>
                                <time>7 Sep 2025</time>
                            </div>
                        </div>
                    </article>

                    <!-- Article 2 -->
                    <article class="card bg-base-100 shadow-lg glass-card" data-aos="fade-up" data-aos-delay="100">
                        <figure>
                            <img src="https://placehold.co/400x200/f093fb/ffffff?text=Node.js+Express" alt="Node.js Express"
                                class="w-full h-48 object-cover" />
                        </figure>
                        <div class="card-body">
                            <div class="flex flex-wrap gap-1 mb-2">
                                <div class="badge badge-warning badge-sm">node.js</div>
                                <div class="badge badge-outline badge-sm">backend</div>
                            </div>
                            <h3 class="card-title text-lg">
                                <a href="#" class="link link-hover">Membangun REST API dengan Node.js dan Express</a>
                            </h3>
                            <p class="text-sm text-base-content/70 mb-3">
                                Tutorial lengkap membuat REST API menggunakan Node.js, Express, dan MongoDB untuk aplikasi
                                web modern.
                            </p>
                            <div class="flex justify-between items-center text-xs text-base-content/60">
                                <div class="flex items-center gap-1">
                                    <div class="avatar placeholder">
                                        <div class="bg-warning text-warning-content rounded-full w-6">
                                            <span class="text-xs">BD</span>
                                        </div>
                                    </div>
                                    <span>Bob Dev</span>
                                </div>
                                <time>5 Sep 2025</time>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-8" data-aos="fade-up" data-aos-delay="100">
                    <button class="btn btn-outline btn-primary btn-wide">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Muat Artikel Lainnya
                    </button>
                </div>
            </div>

            <!-- Sidebar (1/3 width) -->
            <aside class="space-y-6">
                <!-- Search Widget -->
                <div class="card bg-base-100 shadow-lg glass-card" data-aos="fade-left">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Pencarian
                        </h3>
                        <div class="form-control">
                            <div class="input-group">
                                <input type="text" placeholder="Cari artikel..." class="input input-bordered flex-1" />
                                <button class="btn btn-square btn-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

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
                            <article
                                class="flex items-start space-x-3 p-3 rounded-lg bg-primary/5 hover:bg-primary/10 transition-colors">
                                <div
                                    class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    💻
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-sm leading-tight">
                                        <a href="#" class="hover:text-primary">Belajar JavaScript Modern ES6+</a>
                                    </h4>
                                    <div class="flex items-center text-xs text-base-content/60 mt-1">
                                        <span>5 Sep 2025</span>
                                        <span class="mx-1">•</span>
                                        <span>1,234 views</span>
                                    </div>
                                </div>
                            </article>

                            <article
                                class="flex items-start space-x-3 p-3 rounded-lg bg-success/5 hover:bg-success/10 transition-colors">
                                <div
                                    class="w-12 h-12 bg-success/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    ⚡
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-sm leading-tight">
                                        <a href="#" class="hover:text-success">Tutorial React Hooks untuk Pemula</a>
                                    </h4>
                                    <div class="flex items-center text-xs text-base-content/60 mt-1">
                                        <span>3 Sep 2025</span>
                                        <span class="mx-1">•</span>
                                        <span>956 views</span>
                                    </div>
                                </div>
                            </article>

                            <article
                                class="flex items-start space-x-3 p-3 rounded-lg bg-warning/5 hover:bg-warning/10 transition-colors">
                                <div
                                    class="w-12 h-12 bg-warning/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    🎨
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-sm leading-tight">
                                        <a href="#" class="hover:text-warning">CSS Grid vs Flexbox: Panduan
                                            Lengkap</a>
                                    </h4>
                                    <div class="flex items-center text-xs text-base-content/60 mt-1">
                                        <span>1 Sep 2025</span>
                                        <span class="mx-1">•</span>
                                        <span>745 views</span>
                                    </div>
                                </div>
                            </article>

                            <article
                                class="flex items-start space-x-3 p-3 rounded-lg bg-secondary/5 hover:bg-secondary/10 transition-colors">
                                <div
                                    class="w-12 h-12 bg-secondary/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    ⚡
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-sm leading-tight">
                                        <a href="#" class="hover:text-secondary">JavaScript ES2023: Fitur
                                            Terbaru</a>
                                    </h4>
                                    <div class="flex items-center text-xs text-base-content/60 mt-1">
                                        <span>28 Aug 2025</span>
                                        <span class="mx-1">•</span>
                                        <span>542 views</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="#" class="btn btn-outline btn-info btn-sm">Lihat Semua</a>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card bg-base-100 shadow-lg glass-card" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Kategori
                        </h3>
                        <div class="space-y-2">
                            <a href="category-web-development.html"
                                class="flex justify-between items-center p-2 rounded-lg hover:bg-primary/10 transition-colors">
                                <span class="flex items-center gap-2">
                                    💻 <span>Web Development</span>
                                </span>
                                <div class="badge badge-primary badge-sm">24</div>
                            </a>
                            <a href="category-programming.html"
                                class="flex justify-between items-center p-2 rounded-lg hover:bg-success/10 transition-colors">
                                <span class="flex items-center gap-2">
                                    ⚡ <span>Programming</span>
                                </span>
                                <div class="badge badge-success badge-sm">18</div>
                            </a>
                            <a href="category-ui-ux-design.html"
                                class="flex justify-between items-center p-2 rounded-lg hover:bg-warning/10 transition-colors">
                                <span class="flex items-center gap-2">
                                    🎨 <span>UI/UX Design</span>
                                </span>
                                <div class="badge badge-warning badge-sm">12</div>
                            </a>
                            <a href="category-mobile-development.html"
                                class="flex justify-between items-center p-2 rounded-lg hover:bg-info/10 transition-colors">
                                <span class="flex items-center gap-2">
                                    📱 <span>Mobile Development</span>
                                </span>
                                <div class="badge badge-info badge-sm">9</div>
                            </a>
                            <a href="category-devops.html"
                                class="flex justify-between items-center p-2 rounded-lg hover:bg-error/10 transition-colors">
                                <span class="flex items-center gap-2">
                                    ⚙️ <span>DevOps</span>
                                </span>
                                <div class="badge badge-error badge-sm">6</div>
                            </a>
                        </div>
                        <div class="mt-4 text-center">
                            <a href="categories.html" class="btn btn-outline btn-sm">Lihat Semua Kategori</a>
                        </div>
                    </div>
                </div>



                <!-- Social Media Widget -->
                <div class="card bg-base-100 shadow-lg glass-card" data-aos="fade-left" data-aos-delay="100">
                    <div class="card-body">
                        <h3 class="card-title text-lg mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Terhubung dengan Kami
                        </h3>
                        <p class="text-sm text-base-content/60 mb-4">Ikuti kami di media sosial untuk update terbaru dan
                            konten eksklusif!</p>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="#" class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white border-0">
                                📘 Facebook
                                <div class="badge badge-ghost badge-sm">25K</div>
                            </a>
                            <a href="#" class="btn btn-sm bg-sky-500 hover:bg-sky-600 text-white border-0">
                                🐦 Twitter
                                <div class="badge badge-ghost badge-sm">15K</div>
                            </a>
                            <a href="#" class="btn btn-sm bg-pink-600 hover:bg-pink-700 text-white border-0">
                                📷 Instagram
                                <div class="badge badge-ghost badge-sm">18K</div>
                            </a>
                            <a href="#" class="btn btn-sm bg-gray-800 hover:bg-gray-900 text-white border-0">
                                💻 GitHub
                                <div class="badge badge-ghost badge-sm">5K</div>
                            </a>
                        </div>
                    </div>
                </div>

            </aside>
        </div>
    </div>
@endsection
