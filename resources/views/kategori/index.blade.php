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

                    <a href="{{ route('kategori.create') }}">
                        <button type="button" class="btn btn-info mb-3">
                            Tambah Kategori
                        </button>
                    </a>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="mb-4 text-center">Data Kategori</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategori as $kategori)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $kategori->nama_kategori }}</td>
                                                <td>
                                                    <a href="{{ route('kategori.edit', $kategori->id_kategori) }}" class="btn btn-success">
                                                        <iconify-icon icon="tabler:pencil" class="fs-6"></iconify-icon>
                                                    </a>

                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteKategoriModal{{ $kategori->id_kategori }}">
                                                        <iconify-icon icon="tabler:trash" class="fs-6"></iconify-icon>
                                                    </button>
                                                    @include('partials.kategori.modal_delete_kategori')
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