@extends('layout.user.main')
@section('container')
    <div class="hero-section">
        <div class="hero-overlay">
            <div class="container text-center">
                <h1 class="hero-title">PERPUSTAKAAN</h1>
                <h2 class="hero-subtitle">DIGITAL</h2>
                <div class="search-box mx-auto">
                    <div class="input-group">
                        <input type="text" id="search" class="form-control border-0" placeholder="Cari buku favorit Anda...">
                        {{-- <button class="btn btn-warning">Cari</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 book-container">
        @forelse ($buku as $buku)
            <a href="{{ route('show.book', ['slug_judul_buku' => $buku->slug_judul_buku]) }}"class="book-item">
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-img p-3">
                            <img src="{{ asset('storage/' . $buku->sampul_buku) }}" class="card-img-top" alt="Sampul Buku">
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2 text-muted">{{ $buku->penulis_buku }}</h6>
                            <h5 class="card-title">{{ $buku->judul_buku }}</h5>
                            <div class="d-flex align-items-center gap-2">
                                <span class="rating">{{ number_format($buku->rataRataRating, 1) }}/5</span>
                                <span class="review-count">{{ $buku->jumlahUlasan }} Ulasan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center">Belum ada buku</div>
        @endforelse
        <div class="container text-center py-5">
            <div class="text-danger fw-bold" id="message"></div>
        </div>
    </div>

    <div class="text-center text-muted pt-5">
        <p>© Copyright 2025 All Rights Reserved.</p>
    </div>
@endsection

@push('style')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Galindo&display=swap');

        .hero-section {
            position: relative;
            background-image: url('https://asset.kompas.com/crops/Yn331T3ABD2Twkqhp_sO-K0m6Go=/429x39:5529x3439/750x500/data/photo/2021/05/10/609931bb5334c.jpg');
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            overflow: hidden;
            margin: 20px 0;
        }

        .hero-overlay {
            background: rgba(0, 0, 0, 0.7);
            padding: 80px 0;
        }

        .hero-title {
            font-family: "Galindo", serif;
            font-weight: 400;
            font-style: normal;
            font-size: 3.5rem;
            color: #FFD700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
        }

        .hero-subtitle {
            font-family: "Galindo", serif;
            font-weight: 400;
            font-style: normal;
            font-size: 2rem;
            color: #42cb42;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .search-box {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 30px;
            padding: 10px 20px;
            margin-top: 20px;
            max-width: 600px;
        }

        .card {
            border-radius: 20px;
            overflow: hidden;
            background: #e9fcfc;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            cursor: pointer;
        }

        .card-img img {
            border-radius: 10px;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 0 20px 20px 20px !important;
        }

        .rating {
            background: rgba(0, 0, 0, 0.05);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 14px;
        }

        .review-count {
            color: #666;
            font-size: 14px;
        }

        a {
            text-decoration: none;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('js/searchBook.js') }}"></script>
@endpush