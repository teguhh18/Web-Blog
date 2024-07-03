<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.kategori.index') }}">
                        <i class=""></i><span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.berita.index') }}">
                        <i class=""></i><span>Berita</span>
                    </a>
                </li>
                
            </ul>
        </li><!-- End Components Nav --> --}}

        {{-- <li class="nav-heading">Pages</li> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.kategori.index') }}">
                <i class="bi bi-journal"></i>
                <span>Kategori</span>
            </a>
        </li><!-- End Profile Page Nav -->
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.berita.index') }}">
                <i class="bi bi-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.user.index') }}">
                <i class="bi bi-person"></i>
                <span>Data User</span>
            </a>
        </li>
        <!-- End Login Page Nav -->

        

       

    </ul>

</aside><!-- End Sidebar-->
