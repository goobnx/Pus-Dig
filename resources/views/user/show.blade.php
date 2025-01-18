@extends('layout.user.main')
@section('container')

    <div class="row mb-5">
        <div class="col-md-4 text-center text-md-start mb-4 mb-md-0">
            <img src="{{ asset('storage/' . $buku->sampul_buku) }}" alt="Sampul Buku" class="book-cover">
        </div>
        <div class="col-md-8">
            <h5 class="text-muted mb-2">{{ $buku->penulis_buku }}</h5>
            <h2 class="mb-3">{{ $buku->judul_buku }}</h2>

            <div class="rating-large mb-3">
                <span class="score">{{ number_format($rataRataRating, 1) }}</span>/5 | {{ $jumlahUlasan }} Ulasan
            </div>

            <h5 class="mb-3">Sinopsis</h5>
            <p class="mb-4">{{ $buku->sinopsis_buku }}</p>

            <h5 class="mb-3">Kategori</h5>
            <div class="mb-4">
                @if ($buku->kategori->isNotEmpty())
                    @foreach ($buku->kategori as $kategori)
                        <span class="category-badge">{{ $kategori->nama_kategori }}</span>
                    @endforeach
                @else
                    <p>Buku ini belum memiliki kategori.</p>
                @endif
            </div>

            @if (auth()->check() && auth()->user()->role === 'peminjam')
                <div class="row mb-2">
                    <div class="col-8">
                        @if ($statusPeminjaman === 'belum_pinjam' || $statusPeminjaman === 'selesai_pinjam')
                            <form action="{{ route('process.peminjaman', $buku->slug_judul_buku) }}" method="POST">
                                @csrf
                                <button class="btn btn-warning w-100 text-white">
                                    <span><i class="fa fa-book"></i></span> &nbsp;Pinjam Buku
                                </button>
                            </form>
                        @elseif ($statusPeminjaman === 'verifikasi_peminjaman')
                            <button class="btn btn-success w-100 text-white">
                                <span><i class="fa-solid fa-check-to-slot"></i></span> &nbsp;Peminjaman sedang Diverifikasi
                            </button>
                        @elseif ($statusPeminjaman === 'verifikasi_pengembalian')
                            <button class="btn btn-success w-100 text-white">
                                <span><i class="fa-solid fa-check-to-slot"></i></span> &nbsp;Pengembalian sedang Diverifikasi
                            </button>
                        @elseif ($statusPeminjaman === 'sedang_pinjam')
                            <div class="mb-2">
                                <button class="btn btn-info w-100 text-white">
                                    <span><i class="fa-solid fa-handshake"></i></span> &nbsp;Siap Dibaca
                                </button>
                            </div>
                            <div class="mb-2 text-center">
                                <form action="{{ route('process.pengembalian', $buku->slug_judul_buku) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger w-50 text-white">
                                        <span><i class="fa-solid fa-undo"></i></span> &nbsp;Kembalikan Buku
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <div class="col-4">
                        <div class="mb-2">
                            @if ($adaDiKoleksi)
                                <button class="btn btn-danger text-white" disabled>
                                    <span><i class="fa-solid fa-heart-circle-check"></i></span> &nbsp;Sudah Ditambah ke Koleksi
                                </button>
                            @else
                                <form action="{{ route('store.koleksi', $buku->slug_judul_buku) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger text-white">
                                        <span><i class="fa-solid fa-heart-circle-plus"></i></span> &nbsp;Tambah ke Koleksi
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (auth()->check() && auth()->user()->role === 'peminjam')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <form 
                        action="{{ $ulasan ? route('update.ulasan', $ulasan->id_ulasan) : route('store.ulasan', $buku->slug_judul_buku) }}" 
                        method="POST" 
                        enctype="multipart/form-data">
                        @csrf
                        @if ($ulasan)
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{ $ulasan ? 'Edit Ulasan Anda' : 'Berikan Ulasan Anda' }}</h4>
                            <div class="mb-4">
                                <label class="form-label">Rating</label>
                                <div class="star-rating">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input 
                                            type="radio" 
                                            id="star{{ $i }}" 
                                            name="rating" 
                                            value="{{ $i }}" 
                                            {{ old('rating', $ulasan->rating ?? '') == $i ? 'checked' : '' }}>
                                        <label for="star{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="isi_ulasan" class="form-label">Ulasan Anda</label>
                                <textarea 
                                    class="form-control" 
                                    name="isi_ulasan" 
                                    id="isi_ulasan" 
                                    rows="4" 
                                    placeholder="Bagikan pendapat Anda tentang buku ini...">{{ old('isi_ulasan', $ulasan->isi_ulasan ?? '') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="ti ti-pencil"></i>
                                {{ $ulasan ? 'Edit Ulasan' : 'Kirim Ulasan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mb-0">Rating dan ulasan</h2>
                </div>
            </div>
        </div>

        <div class="row align-items-center mb-4">
            <div class="col-md-3 text-center">
                <div class="overall-rating">{{ number_format($rataRataRating, 1) }}</div>
                <div class="rating-star text-warning">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="my-2 review-count">{{ $jumlahRating }}</div>
            </div>

            @if ($jumlahRating > 0)
                <div class="col-md-9 rating-bars">
                    @foreach ($ratingPersentase as $rating => $persentase)
                        <div class="row align-items-center mb-2">
                            <div class="col-1">{{ $rating }}</div>
                            <div class="col-11">
                                <div class="progress">
                                    <div class="progress-bar bg-primary" style="width: {{ $persentase }}%">
                                        {{ $hitungRating[$rating] ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center">Belum ada rating untuk buku ini.</p>
            @endif
        </div>

        @forelse ($semuaUlasan as $ulasan)
            <div class="user-review p-4">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex align-items-center">
                        <img src="{{ $ulasan->user && $ulasan->user->photo ? asset('storage/' . $ulasan->user->photo) : asset('img/profile/user-1.jpg') }}"
                            class="rounded-circle me-2" alt="User avatar"
                            style="width: 45px; height: 45px; object-fit: cover;">
                        <div>
                            <div class="fw-bold">{{ $ulasan->user->username }}</div>
                            <div class="rating-star">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fas fa-star {{ $i <= $ulasan->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                                <small class="text-dark ms-2">{{ $ulasan->created_at->format('d/m/y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mb-2">{{ $ulasan->isi_ulasan ?? '' }}</p>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada ulasan untuk buku ini.</p>
        @endforelse
    </div>

@endsection

@push('style')
    <style>
        .book-cover {
            width: 300px;
            height: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            object-fit: cover;
            object-position: center;
        }

        .rating-large {
            font-size: 20px;
            color: #666;
        }

        .rating-large .score {
            font-weight: bold;
            color: #000;
        }

        .category-badge {
            background-color: #f0f0f0;
            padding: 5px 15px;
            border-radius: 20px;
            margin-right: 10px;
            color: #666;
            display: inline-block;
            margin-bottom: 5px;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 24px;
            padding: 0 2px;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            color: #ffd700;
        }

        .rating-bars .progress {
            height: 8px;
            background-color: #333;
        }

        .rating-bars .progress-bar {
            background-color: #8ab4f8;
        }

        .review-card {
            background-color: #121212;
            border: none;
        }

        .overall-rating {
            font-size: 48px;
            font-weight: bold;
        }

        .review-count {
            color: #888;
            font-size: 0.9rem;
        }

        .helpful-count {
            color: #888;
            font-size: 0.9rem;
        }
    </style>
@endpush
