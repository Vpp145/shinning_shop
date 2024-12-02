<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Shinning Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!empty(Auth::guard('admin')->user()->image))
                    <img src="{{ asset('admin/img/photos/' . Auth::guard('admin')->user()->image) }}"
                        class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('admin/img/avatar.png') }}" class="img-circle elevation-2 rounded-circle"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                @if (Session::get('page') == 'dashboard')
                    <?php $active = 'active'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Session::get('page') == 'update-password' ||
                        Session::get('page') == 'update-admin-details' ||
                        Session::get('page') == 'sub-admins')
                    <?php $active = 'active'; ?>
                    <?php $open = 'menu-open'; ?>
                @else
                    <?php $active = ''; ?>
                @endif
                <li class="nav-item {{ $open ?? '' }}">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fa fa-user" aria-hidden="true"></i>
                        <p>
                            Admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Session::get('page') == 'update-password')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/update-password') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Password</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'update-admin-details')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/update-admin-details') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Details</p>
                            </a>
                        </li>
                        @if (Session::get('page') == 'sub-admins')
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/sub-admins') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Admins</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Session::get('page') == 'cms-pages')
                    @php $active = 'active' @endphp
                @else
                    @php $active = '' @endphp
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/cms-pages') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>CMS Pages</p>
                    </a>
                </li>
                @if (Session::get('page') == 'categories')
                    @php $active = 'active' @endphp
                @else
                    @php $active = '' @endphp
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/categories') }}" class="nav-link {{ $active }}">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
                @if (Session::get('page') == 'products')
                    @php $active = 'active' @endphp
                @else
                    @php $active = '' @endphp
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/products') }}" class="nav-link {{ $active }}">
                        <i class="fas fa-box nav-icon"></i>
                        <p>Products</p>
                    </a>
                </li>
                @if (Session::get('page') == 'brands')
                    @php $active = 'active' @endphp
                @else
                    @php $active = '' @endphp
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/brands') }}" class="nav-link {{ $active }}">
                        <i class="fas fa-tags nav-icon"></i>
                        <p>Brands</p>
                    </a>
                </li>
                @if (Session::get('page') == 'banners')
                    @php $active = 'active' @endphp
                @else
                    @php $active = '' @endphp
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/banners') }}" class="nav-link {{ $active }}">
                        <i class="fas fa-sliders-h nav-icon"></i>
                        <p>Banners</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
