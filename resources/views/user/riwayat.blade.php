@extends('layout.user.main')
@section('container')

<div class="row">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Riwayat Peminjaman</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Sampul</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayat as $riwayat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('show.book', ['slug_judul_buku' => $riwayat->buku->slug_judul_buku]) }}">
                                                {{ $riwayat->buku->judul_buku }}
                                            </a>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $riwayat->buku->sampul_buku) }}" style="max-width: 80px;" alt="Sampul Buku">
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($riwayat->tgl_peminjaman)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($riwayat->tgl_pengembalian)->format('d M Y') }}</td>
                                        <td>
                                            @if ($riwayat->status_peminjaman === 'selesai_pinjam')
                                                <span class="badge bg-muted text-white">Selesai Pinjam</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center;">Belum ada riwayat peminjaman.</td>
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