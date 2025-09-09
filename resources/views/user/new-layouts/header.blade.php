<!-- Navigation Bar -->
    <div class="navbar bg-base-100 shadow-lg sticky top-0 z-50">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path>
                    </svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="index.html">🏠 Home</a></li>
                    <li>
                        <a>📁 Kategori</a>
                        <ul class="p-2">
                            <li><a href="category-programming.html">⚡ Programming</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">👤 Tentang</a></li>
                    <li><a href="contact.html">🧩 Kontak</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost text-xl font-bold">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Web Blog
            </a>
        </div>
        
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="index.html" class="btn btn-ghost">🏠 Home</a></li>
                <li>
                    <details>
                        <summary class="btn btn-ghost">📁 Kategori</summary>
                        <ul class="p-2 bg-base-100 rounded-t-none">
                            <li><a href="category-programming.html">⚡ Programming</a></li>
                        </ul>
                    </details>
                </li>
                <li><a href="contact.html" class="btn btn-ghost">🧩 Kontak</a></li>
                <li><a href="about.html" class="btn btn-ghost">👤 Tentang</a></li>
            </ul>
        </div>
        
        <div class="navbar-end">
            <button class="btn btn-ghost btn-circle">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost">
                    🌙 Theme
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a onclick="setTheme('light')">☀️ Light</a></li>
                    <li><a onclick="setTheme('dark')">🌙 Dark</a></li>
                    <li><a onclick="setTheme('cupcake')">🧁 Cupcake</a></li>
                    <li><a onclick="setTheme('bumblebee')">🐝 Bumblebee</a></li>
                </ul>
            </div>
        </div>
    </div>
    