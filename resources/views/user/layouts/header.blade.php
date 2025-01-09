<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ route('user.home') }}" class="logo d-flex align-items-center">
            <h1>MyBlog</h1>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('user.home') }}">Home</a></li>
                <li><a href="{{ route('user.berita') }}">Blog</a></li>
                <li><a href="{{ route('user.kategori') }}">Kategori</a></li>
                <li><a href="{{ route('user.about') }}">About</a></li>
                <li><a href="{{ route('user.contact') }}">Contact</a></li>
            </ul>
        </nav><!-- .navbar -->

        <div class="d-flex align-items-center">
            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>

            @if (Auth::check())
                <div class="dropdown mx-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome, {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                        @if(Auth::user()->level !== 'admin')
                        <li>
                            <a href="{{ route('user.profile', encrypt(auth()->user()->id)) }}" type="submit"
                                class="btn dropdown-item">
                                <i class="bi bi-person"></i> My Profile
                            </a>
                        </li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-in-left"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>


                </div>
            @else
                <a class="btn btn-dark mx-2" href="{{ route('login') }}">Login <i
                        class="bi bi-box-arrow-in-right"></i></a>
            @endif

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="search-result.html" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div>
            <i class="bi bi-list mobile-nav-toggle"></i><!-- End Search Form -->
        </div>
    </div>
</header><!-- End Header -->
