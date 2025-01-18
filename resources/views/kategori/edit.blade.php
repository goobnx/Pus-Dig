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
                    <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            
                            @include('partials.alert.alert')

                            <div class="card mb-4">
                                <div class="card-body">
                                    <h2 class="text-center"><strong>Nama Kategori</strong></h2>
                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="nama_kategori">Nama Kategori<span
                                                    class="text-danger"> *</span></label>
                                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori"
                                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}" placeholder="Masukkan Nama Kategori" autocomplete="off">
                                            @error('nama_kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center text-md-start">
                                        <button type="submit" class="btn btn-success my-3 w-100" style="width: 100%;">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection