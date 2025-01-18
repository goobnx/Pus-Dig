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

                    <a href="{{ route('kategori-buku.create') }}">
                        <button type="button" class="btn btn-info mb-3">
                            Tambah Kategori Buku
                        </button>
                    </a>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="mb-4 text-center">Data Kategori Buku</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Judul Buku</th>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategoriBuku as $kategoriBuku)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $kategoriBuku->buku->judul_buku }}</td>
                                                <td>{{ $kategoriBuku->kategori->nama_kategori }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteKategoriBukuModal{{ $kategoriBuku->id_kategori_buku }}">
                                                        <iconify-icon icon="tabler:trash" class="fs-6"></iconify-icon>
                                                    </button>
                                                    @include('partials.kategori_buku.modal_delete_kategori_buku')
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