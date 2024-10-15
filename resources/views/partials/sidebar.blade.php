<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/kecamatan" class="brand-link" style="background-color: #a8b8de;">
        <img src="{{ asset('assets/img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-medium" style="color: #000;">TrophyHub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #a8b8de;">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/home"
                        class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }} font-weight-medium"
                        style="color: #000;">
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/products') }}"
                        class="nav-link {{ Route::currentRouteName() == 'products' ? 'active' : '' }} font-weight-medium"
                        style="color: #000;">
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/material/add') }}"
                        class="nav-link {{ Route::currentRouteName() == 'products' ? 'active' : '' }} font-weight-medium"
                        style="color: #000;">
                        <p>
                            Bahan
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/bom') }}"
                        class="nav-link {{ Route::currentRouteName() == 'products' ? 'active' : '' }} font-weight-medium"
                        style="color: #000;">
                        <p>
                            BoM
                        </p>
                    </a>
                </li>

                <i class="fas fa-log-out nav-icon"></i>
                <li class="nav-item">
                    {{-- <a class="nav-link" href="{{ route('logout') }}" --}}
                    <a class="nav-link font-weight-medium" href="#"
                        onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                        style="color: #000;">
                        <p>{{ __('Logout') }}</p>
                    </a>
                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form> --}}
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
