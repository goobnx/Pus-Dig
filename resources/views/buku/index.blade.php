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
                    
                    @include('partials.alert.alert')
                    <div id="alert-container"></div>

                    <a href="{{ route('buku.create') }}">
                        <button type="button" class="btn btn-info mb-3">
                            Tambah Buku
                        </button>
                    </a>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="mb-4 text-center">Data Buku</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Sinopsis</th>
                                            <th>Sampul</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($buku as $buku)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $buku->judul_buku }}</td>
                                                <td>{{ $buku->penulis_buku }}</td>
                                                <td>{{ $buku->penerbit_buku }}</td>
                                                <td>{{ $buku->tahunterbit_buku }}</td>
                                                <td>{{ $buku->sinopsis_buku }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $buku->sampul_buku) }}" style="max-width: 80px;" alt="Sampul Buku">
                                                </td>
                                                <td>
                                                    <a href="{{ route('buku.edit', $buku->id_buku) }}" class="btn btn-success">
                                                        <iconify-icon icon="tabler:pencil" class="fs-6"></iconify-icon>
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteBukuModal{{ $buku->id_buku }}">
                                                        <iconify-icon icon="tabler:trash" class="fs-6"></iconify-icon>
                                                    </button>
                                                    @include('partials.buku.modal_delete_buku')
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
    </div>
@endsection