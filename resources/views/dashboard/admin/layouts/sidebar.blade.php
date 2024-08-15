<aside class="left-sidebar with-vertical">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <div>
                <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="">
            </div>
            <div>
                <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                    <i class="ti ti-x"></i>
                </a>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->can('dashboard'))
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @endif

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Warga</span>
                </li>
                @can('read.barang')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('warga.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Data Warga</span>
                    </a>
                </li>
                @endcan
                @can('create.barang')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('warga.create') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Tambah Warga</span>
                    </a>
                </li>
                @endcan

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pembayaran</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('pembayaran.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-moneybag"></i>
                        </span>
                        <span class="hide-menu">Data Pembayaran</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('pembayaran.create') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-coin-monero"></i>
                        </span>
                        <span class="hide-menu">Tambah Pembayaran</span>
                    </a>
                </li>

{{--                <li class="nav-small-cap">--}}
{{--                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>--}}
{{--                    <span class="hide-menu">User & Roles</span>--}}
{{--                </li>--}}
{{--                @can('users')--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">--}}
{{--                        <span>--}}
{{--                            <i class="ti ti-users"></i>--}}
{{--                        </span>--}}
{{--                        <span class="hide-menu">Data Users</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="{{ route('users.create') }}" aria-expanded="false">--}}
{{--                        <span>--}}
{{--                            <i class="ti ti-user"></i>--}}
{{--                        </span>--}}
{{--                        <span class="hide-menu">Tambah Users</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}
{{--                @can('roles')--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="{{ route('roles.index') }}" aria-expanded="false">--}}
{{--                        <span>--}}
{{--                            <i class="ti ti-user-circle"></i>--}}
{{--                        </span>--}}
{{--                        <span class="hide-menu">Data Roles</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="{{ route('roles.create') }}" aria-expanded="false">--}}
{{--                        <span>--}}
{{--                            <i class="ti ti-user-circle"></i>--}}
{{--                        </span>--}}
{{--                        <span class="hide-menu">Tambah Roles</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}
{{--                @can('permission')--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="{{ route('permissions.index') }}" aria-expanded="false">--}}
{{--                        <span>--}}
{{--                            <i class="ti ti-license"></i>--}}
{{--                        </span>--}}
{{--                        <span class="hide-menu">Data Permissions</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="sidebar-item">--}}
{{--                    <a class="sidebar-link" href="{{ route('permissions.create') }}" aria-expanded="false">--}}
{{--                        <span>--}}
{{--                            <i class="ti ti-license"></i>--}}
{{--                        </span>--}}
{{--                        <span class="hide-menu">Tambah Permissions</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endcan--}}
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="{{ asset('assets/images/profile/itdh.jpeg') }}" class="rounded-circle" width="40" height="40" alt="modernize-img">
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">{{ auth()->user()->name }}</h6>
                    <span class="fs-2">{{ auth()->user()->role->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button class="btn btn-sm btn-outline-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Sidebar scroll-->
</aside>

