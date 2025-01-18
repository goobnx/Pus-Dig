@extends('layout.main')
@section('container')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    @include('partials.breadcrumb.breadcrumb', ['pageTitle' => $judulHalaman, 'breadcrumbs' => $breadcrumbs])
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <form action="{{ route('index.peminjaman') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                                <input 
                                    type="date" 
                                    name="tanggal_awal" 
                                    id="tanggal_awal" 
                                    class="form-control" 
                                    value="{{ $tanggalAwal ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                <input 
                                    type="date" 
                                    name="tanggal_akhir" 
                                    id="tanggal_akhir" 
                                    class="form-control" 
                                    value="{{ $tanggalAkhir ?? '' }}">
                            </div>
                            <div class="col-md-3">
                                <label for="status_peminjaman" class="form-label">Status</label>
                                <select name="status_peminjaman" id="status_peminjaman" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="verifikasi_peminjaman" {{ ($statusPeminjaman ?? '') === 'verifikasi_peminjaman' ? 'selected' : '' }}>Verifikasi Peminjaman</option>
                                    <option value="sedang_pinjam" {{ ($statusPeminjaman ?? '') === 'sedang_pinjam' ? 'selected' : '' }}>Sedang Pinjam</option>
                                    <option value="verifikasi_pengembalian" {{ ($statusPeminjaman ?? '') === 'verifikasi_pengembalian' ? 'selected' : '' }}>Verifikasi Pengembalian</option>
                                    <option value="selesai_pinjam" {{ ($statusPeminjaman ?? '') === 'selesai_pinjam' ? 'selected' : '' }}>Selesai Pinjam</option>
                                </select>
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ti ti-filter"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <form action="{{ route('cetak.peminjaman') }}" method="GET" class="mb-4" target="_blank">
                        <input type="hidden" name="tanggal_awal" value="{{ $tanggalAwal ?? '' }}">
                        <input type="hidden" name="tanggal_akhir" value="{{ $tanggalAkhir ?? '' }}">
                        <input type="hidden" name="status_peminjaman" value="{{ $statusPeminjaman ?? '' }}">
                        <button type="submit" class="btn btn-info mb-3">
                            <i class="ti ti-printer"></i> Cetak Laporan
                        </button>
                    </form>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="mb-4 text-center">Data Peminjaman</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Peminjam</th>
                                            <th>Buku</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($peminjaman as $peminjaman)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $peminjaman->user->username }}</td>
                                                <td>{{ $peminjaman->buku->judul_buku }}</td>
                                                <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->format('d M Y') }}</td>
                                                <td>{{ $peminjaman->tgl_pengembalian ? \Carbon\Carbon::parse($peminjaman->tgl_pengembalian)->format('d M Y') : '-' }}</td>
                                                <td>
                                                    @if ($peminjaman->status_peminjaman === 'verifikasi_peminjaman')
                                                        <form action="{{ route('verifikasi.peminjaman', $peminjaman->id_peminjaman) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning">
                                                                <i class="ti ti-pencil"></i> Verifikasi Peminjaman
                                                            </button>
                                                        </form>
                                                    @elseif ($peminjaman->status_peminjaman === 'sedang_pinjam')
                                                        <span class="badge bg-success text-white">Sedang Pinjam</span>
                                                    @elseif ($peminjaman->status_peminjaman === 'verifikasi_pengembalian')
                                                        <form action="{{ route('verifikasi.pengembalian', $peminjaman->id_peminjaman) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-info">
                                                                <i class="ti ti-pencil"></i> Verifikasi Pengembalian
                                                            </button>
                                                        </form>
                                                    @elseif ($peminjaman->status_peminjaman === 'selesai_pinjam')
                                                        <span class="badge bg-muted text-white">Selesai Pinjam</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data yang ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection