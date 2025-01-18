@extends('layout.user.main')
@section('container')

<div class="row">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Peminjaman Saya</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Sampul</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjaman as $peminjaman)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('show.book', ['slug_judul_buku' => $peminjaman->buku->slug_judul_buku]) }}">
                                                {{ $peminjaman->buku->judul_buku }}
                                            </a>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $peminjaman->buku->sampul_buku) }}" style="max-width: 80px;" alt="Sampul Buku">
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_peminjaman)->format('d M Y') }}</td>
                                        <td>
                                            @if ($peminjaman->status_peminjaman === 'verifikasi_peminjaman')
                                                <span class="badge bg-warning text-white">Menunggu Verifikasi Peminjaman</span>
                                            @elseif ($peminjaman->status_peminjaman === 'sedang_pinjam')
                                                <span class="badge bg-success text-white">Sedang Pinjam</span>
                                            @elseif ($peminjaman->status_peminjaman === 'verifikasi_pengembalian')
                                                <span class="badge bg-info text-white">Menunggu Verifikasi Pengembalian</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center;">Tidak ada data peminjaman.</td>
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
@endsection