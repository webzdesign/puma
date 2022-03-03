<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('public/assets/img/noimage.jpg') }}" alt="Site Logo"
            style="width:50px;height:50px;border-radius:10px;">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('home') }}"
                    class="d-block text-capitalize">{{ Auth::check() ? Auth::user()->name : 'ADMIN' }}</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('#') || Request::is('#/*') ? 'active' : '' }}">
                        <i class="fa fa-edit nav-icon"></i>
                        <p>About</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ Request::is('user') || Request::is('user/*') || Request::is('role') || Request::is('role/*')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('user') || Request::is('user/*') || Request::is('role') || Request::is('role/*')? 'active': '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p> Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user') }}"
                                class="nav-link {{ Request::is('user') || Request::is('user/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon pl-2"></i>
                                <p>User Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('role') }}"
                                class="nav-link {{ Request::is('role') || Request::is('role/*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon pl-2"></i>
                                <p>Roles/Permission</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
