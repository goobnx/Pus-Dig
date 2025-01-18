@extends('layout.main')
@section('container')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    @include('partials.breadcrumb.breadcrumb', ['pageTitle' => $judulHalaman, 'breadcrumbs' => $breadcrumbs])
                </div>
            </div>
                    
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('buku.index') }}">
                            <div class="card border-left-success shadow h-75 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success mb-1">Buku</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBuku ?? '0' }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <iconify-icon icon="tabler:book" class="text-success" style="font-size: 36px"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('kategori.index') }}">
                            <div class="card border-left-primary shadow h-75 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary mb-1">Kategori</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKategori ?? '0' }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <iconify-icon icon="tabler:bookmark" class="text-primary" style="font-size: 36px"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <div class="col-xl-4 col-md-6">
                            <a href="{{ route('akun.index') }}">
                                <div class="card border-left-warning shadow h-75 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning mb-1">Akun</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUser ?? '0' }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <iconify-icon icon="tabler:user-plus" class="text-warning" style="font-size: 36px"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-12">
                            <a href="{{ route('index.peminjaman') }}">
                                <div class="card border-left-danger shadow h-75 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger mb-1">Peminjaman</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPeminjaman ?? '0' }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <iconify-icon icon="tabler:file-description" class="text-danger" style="font-size: 36px"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    @elseif (auth()->check() && auth()->user()->role === 'petugas')
                        <div class="col-xl-4 col-md-6">
                            <a href="{{ route('index.peminjaman') }}">
                                <div class="card border-left-danger shadow h-75 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger mb-1">Peminjaman</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPeminjaman ?? '0' }}</div>
                                            </div>
                                            <div class="col-auto">
                                                <iconify-icon icon="tabler:file-description" class="text-danger" style="font-size: 36px"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .card {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
        }
    </style>
@endpush