<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/home*') ? '' : 'collapsed' }}" href="{{ route('admin.home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/kategori*') ? '' : 'collapsed' }}" href="{{ route('admin.kategori.index') }}">
                <i class="bi bi-journal"></i>
                <span>Kategori</span>
            </a>
        </li><!-- End Profile Page Nav -->
        
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/berita*') ? '' : 'collapsed' }}" href="{{ route('admin.berita.index') }}">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/user*') ? '' : 'collapsed' }}" href="{{ route('admin.user.index') }}">
                <i class="bi bi-person"></i>
                <span>Data User</span>
            </a>
        </li>
        <!-- End Login Page Nav -->

    </ul>

</aside><!-- End Sidebar-->
