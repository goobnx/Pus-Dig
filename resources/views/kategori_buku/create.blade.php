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
                    <form action="{{ route('kategori-buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            
                            @include('partials.alert.alert')

                            <div class="card mb-4">
                                <div class="card-body">
                                    <h2 class="text-center"><strong>Kategori Buku</strong></h2>
                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="id_buku">Judul Buku<span
                                                    class="text-danger"> *</span></label>
                                            <select name="id_buku" class="form-control @error('id_buku') is-invalid @enderror">
                                                <option value="" disabled selected>Pilih Buku</option>
                                                @foreach ($buku as $buku)
                                                    <option value="{{ $buku->id_buku }}">
                                                        {{ $buku->judul_buku }}</option>
                                                @endforeach
                                            </select>

                                            @error('id_buku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="id_kategori">Kategori<span
                                                    class="text-danger"> *</span></label>
                                            @foreach ($kategori as $kategori)
                                                <div class="form-check">
                                                    <input type="checkbox" name="id_kategori[]" value="{{ $kategori->id_kategori }}" class="form-check-input">
                                                    <label class="form-check-label">{{ $kategori->nama_kategori }}</label>
                                                </div>
                                            @endforeach
                                            @error('id_kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-center text-md-start">
                                        <button type="submit" class="btn btn-info my-3 w-100" style="width: 100%;">
                                            Tambah
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