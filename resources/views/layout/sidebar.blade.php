<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home.index') }}" class="text-nowrap logo-img">
                <img src="{{ asset('img/logos/logo-sidebar.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Dashboard</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('buku.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-book"></i>
                        </span>
                        <span class="hide-menu">Buku</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('kategori-buku.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Kategori Buku</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('index.peminjaman') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-description"></i>
                        </span>
                        <span class="hide-menu">Peminjaman</span>
                        @if ($totalVerifikasi > 0)
                            <span
                                class="notification-badge badge bg-primary rounded-circle d-flex align-items-center justify-content-center ms-2">
                                {{ $totalVerifikasi }}
                            </span>
                        @endif
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MASTER MENU</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('kategori.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-bookmark"></i>
                        </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>

                @if (auth()->check() && auth()->user()->role === 'admin')
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('akun.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user-plus"></i>
                            </span>
                            <span class="hide-menu">Akun</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>

<style>
    .notification-badge {
        width: 20px;
        height: 20px;
        min-width: 20px;
        padding: 0;
        font-size: 11px;
        font-weight: 600;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(53, 148, 220, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
        }
    }

    .hide-menu {
        width: 100%;
    }

    .rotate-icon {
        transition: transform 0.3s ease;
        display: inline-block;
    }

    .has-arrow[aria-expanded="true"] .rotate-icon {
        transform: rotate(90deg);
    }
</style>