@extends('layout.user.main')
@section('container')

<div class="row">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-4 text-center">Koleksi Buku Saya</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Sampul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($koleksi as $koleksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ route('show.book', ['slug_judul_buku' => $koleksi->buku->slug_judul_buku]) }}">
                                                {{ $koleksi->buku->judul_buku }}
                                            </a>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $koleksi->buku->sampul_buku) }}" style="max-width: 80px;" alt="Sampul Buku">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteKoleksiModal{{ $koleksi->id_koleksi }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            @include('partials.koleksi.modal_delete_koleksi')
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection