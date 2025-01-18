<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                @if (!Auth::check())
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>&nbsp;&nbsp;
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endif

                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('img/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                @php
                                    $menus = [
                                        'peminjam' => [
                                            ['route' => 'index.book', 'icon' => 'ti-layout-dashboard', 'label' => 'Dashboard'],
                                            ['route' => 'profilUser.index', 'icon' => 'ti-user', 'label' => 'Profil Saya'],
                                            ['route' => 'indexPeminjaman', 'icon' => 'ti-file-description', 'label' => 'Peminjaman Saya'],
                                            ['route' => 'index.koleksi', 'icon' => 'ti-book', 'label' => 'Koleksi Buku'],
                                            ['route' => 'index.ubahPasswordUser', 'icon' => 'ti-key', 'label' => 'Ubah Password'],
                                        ],
                                        'admin' => [
                                            ['route' => 'home.index', 'icon' => 'ti-user', 'label' => 'Dashboard'],
                                        ],
                                        'petugas' => [
                                            ['route' => 'home.index', 'icon' => 'ti-user', 'label' => 'Dashboard'],
                                        ],
                                    ];
                                @endphp

                                @if (isset($menus[Auth::user()->role]))
                                    @foreach ($menus[Auth::user()->role] as $menu)
                                        <a href="{{ route($menu['route']) }}" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti {{ $menu['icon'] }} fs-6"></i>
                                            <p class="mb-0 fs-3">{{ $menu['label'] }}</p>
                                        </a>
                                    @endforeach
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                        <p class="dropdown-item mb-0 fs-3">Saat ini Login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
                                    @endif
                                @endif
                                <form action="{{ route('process.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <div class="container">
                                        <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#modalLogout">
                                            Logout
                                        </button>
                                    </div>                                            
                                </form>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>