<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset(Helper::settings() ? 'storage/app/logo/' . Helper::settings()->logo : 'public/assets/img/noimage.jpg') }}"
            alt="Site Logo" style="margin:0px 10px;max-width:60px;max-height:60px;border-radius:10px;">
        <span class="ml-2 brand-text font-weight-light">{{ Helper::settings() == null ? 'PUMA' : Helper::settings()->title }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('home') }}"
                    class="d-block text-capitalize">{{ Auth::check() ? Auth::user()->name : 'ADMIN' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @permission('view.users')
                <li class="nav-item has-treeview {{ Request::is('user') || Request::is('user/*') || Request::is('role') || Request::is('role/*')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('user') || Request::is('user/*') || Request::is('role') || Request::is('role/*') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p> Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- @permission('view.users') -->
                        <li class="nav-item">
                            <a href="{{ route('user') }}"
                                class="nav-link {{ Request::is('user') || Request::is('user/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon pl-2"></i>
                                <p>User Details</p>
                            </a>
                        </li>
                        <!-- @endpermission -->
                        @permission('view.roles')
                            <li class="nav-item">
                                <a href="{{ route('role') }}"
                                    class="nav-link {{ Request::is('role') || Request::is('role/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon pl-2"></i>
                                    <p>Roles/Permission</p>
                                </a>
                            </li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                
                @permission('view.category')
                <li class="nav-item">
                    <a href="{{ route('category') }}" class="nav-link {{ Request::is('category') || Request::is('category/*') ? 'active' : '' }}">
                        <i class="ion ion-bag nav-icon"></i>
                        <p>Category</p>
                    </a>
                </li>
                @endpermission
{{--
                <li class="nav-item">

                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('#') || Request::is('#/*') ? 'active' : '' }}">
                        <i class="fa fa-edit nav-icon"></i>
                        <p>Text</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('settings') }}"
                        class="nav-link {{ Request::is('settings') || Request::is('settings/*') ? 'active' : '' }}">
                        <i class="fa fa-cog nav-icon"></i>
                        <p>Settings</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('#') || Request::is('#/*') ? 'active' : '' }}">
                        <i class="fa fa-edit nav-icon"></i>
                        <p>Text</p>
                    </a>
                </li> --}}

            </ul>
        </nav>
    </div>
</aside>
