<!-- Navigation Bar -->
<div class="navbar bg-base-100 shadow-md sticky top-0 z-50 border-b border-base-200">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16">
                    </path>
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('user.home') }}">Home</a></li>
                <li><a href="{{ route('user.berita') }}">Blog</a></li>
                <li>
                    <a>Kategori</a>
                    <ul class="p-2">
                        @foreach ($dataKategori as $kategori)
                            <li><a href="{{ route('user.berita.kategori', $kategori->slug) }}">
                                    {{ $kategori->nama }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @if (isset($tools) && $tools->isNotEmpty())
                    <li>
                        <a>Tools</a>
                        <ul class="p-2">
                            @foreach ($tools as $tool)
                                <li><a href="{{ route('user.tools.show', $tool->slug) }}">{{ $tool->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                <li><a href="{{ route('user.about') }}">Tentang</a></li>
            </ul>
        </div>
        <a class="btn btn-ghost text-xl font-bold gap-2" href="{{ route('user.home') }}">
            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Web Blog
        </a>
    </div>

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1 gap-1">
            <li><a href="{{ route('user.home') }}" class="btn btn-ghost btn-sm">Home</a></li>
            <li><a href="{{ route('user.berita') }}" class="btn btn-ghost btn-sm">Blog</a></li>
            <li>
                <details>
                    <summary class="btn btn-ghost btn-sm">Kategori</summary>
                    <ul class="p-2 bg-base-100 rounded-t-none shadow-lg">
                        @foreach ($dataKategori as $kategori)
                            <li><a
                                    href="{{ route('user.berita.kategori', $kategori->slug) }}">{{ $kategori->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                </details>
            </li>
            @if (isset($tools) && $tools->isNotEmpty())
                <li>
                    <details>
                        <summary class="btn btn-ghost btn-sm">Tools</summary>
                        <ul class="p-2 bg-base-100 rounded-t-none shadow-lg">
                            @foreach ($tools as $tool)
                                <li><a href="{{ route('user.tools.show', $tool->slug) }}">{{ $tool->name }}</a></li>
                            @endforeach
                        </ul>
                    </details>
                </li>
            @endif
            <li><a href="{{ route('user.about') }}" class="btn btn-ghost btn-sm">Tentang</a></li>
        </ul>
    </div>

    <div class="navbar-end gap-1">
        <form action="{{ route('user.berita.search') }}" method="GET" class="hidden sm:block">
            @csrf
            <input type="text" name="search" placeholder="Search"
                class="input input-bordered input-sm w-32 md:w-auto" />
        </form>
        <button class="btn btn-ghost btn-circle btn-sm sm:hidden" onclick="document.querySelector('input[name=search]').focus()">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>

        <!-- Theme Switcher -->
        <label class="swap swap-rotate btn btn-ghost btn-circle btn-sm">
            <input type="checkbox" id="theme-toggle" />
            <!-- Sun icon (shown in dark mode) -->
            <svg class="swap-on fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z"/>
            </svg>
            <!-- Moon icon (shown in light mode) -->
            <svg class="swap-off fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"/>
            </svg>
        </label>

        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-sm gap-2">
                    <div class="avatar avatar-placeholder">
                        <div class="bg-primary text-primary-content rounded-full w-8">
                            @if (Auth::user()->foto)
                                <img src="{{ route('storage.show', ['path' => Auth::user()->foto]) }}" alt="{{ Auth::user()->name }}">
                            @else
                                <span class="text-sm font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-lg bg-base-100 rounded-box w-52">
                    @if (Auth::user()->level !== 'admin')
                        <li>
                            <a href="{{ route('user.profile', encrypt(auth()->user()->id)) }}">
                                My Profile
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                Login
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                </svg>
            </a>
        @endauth
    </div>
</div>
