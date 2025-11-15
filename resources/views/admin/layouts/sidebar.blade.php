<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/home*') ? '' : 'collapsed' }}" href="{{ route('admin.home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @can('kategori-read')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/kategori*') ? '' : 'collapsed' }}"
                    href="{{ route('admin.kategori.index') }}">
                    <i class="bi bi-journal"></i>
                    <span>Kategori</span>
                </a>
            </li>
        @endcan

        @can('ai-read')
        <li class="nav-item">
            <a href="{{ route('admin.role-ai.index') }}" class="nav-link {{ request()->is('admin/role-ai*') ? '' : 'collapsed' }}">
                <i class="bi bi-cpu"></i><span>Role AI</span>
            </a>
        </li>
        @endcan
        @can('template-image-read')
        <li class="nav-item">
            <a href="{{ route('admin.template-image.index') }}"
                class="nav-link {{ request()->is('admin/template-image*') ? '' : 'collapsed' }}">
                <i class="bi bi-image"></i><span>Template Image</span>
            </a>
        </li>
        @endcan
        @can('berita-read')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/berita*') ? '' : 'collapsed' }}"
                    href="{{ route('admin.berita.index') }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>
        @endcan
        @can('tools-read')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/tools*') ? '' : 'collapsed' }}"
                    href="{{ route('admin.tools.index') }}">
                    <i class="bi bi-tools"></i>
                    <span>Tools</span>
                </a>
            </li>
        @endcan
        @can('comment-read')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/comment*') ? '' : 'collapsed' }}"
                    href="{{ route('admin.comment.index') }}">
                    <i class="bi bi-chat-dots"></i>
                    <span>Data Comment</span>
                </a>
            </li>
        @endcan

        @can('user-read')
            <li class="nav-heading">User Management</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users*') ? '' : 'collapsed' }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Data User</span>
                </a>
            </li>
        @endcan
        @can('role-read')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/roles*') ? '' : 'collapsed' }}"
                    href="{{ route('admin.roles.index') }}">
                    <i class="bi bi-person-vcard-fill"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endcan

        @can('permission-read')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/permissions*') ? '' : 'collapsed' }}"
                    href="{{ route('admin.permissions.index') }}">
                    <i class="bi bi-person-fill-gear"></i>
                    <span>Permission</span>
                </a>
            </li>
        @endcan
        <!-- End Login Page Nav -->

    </ul>

</aside>
