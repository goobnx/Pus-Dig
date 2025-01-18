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
                    <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h2 class="text-center"><strong>Tambah Buku</strong></h2>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="judul_buku">Judul Buku<span
                                                    class="text-danger"> *</span></label>
                                            <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" id="judul_buku" name="judul_buku"
                                                value="{{ old('judul_buku') }}" placeholder="Masukkan Judul Buku" autocomplete="off">
                                            @error('judul_buku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="penulis_buku">Penulis Buku<span
                                                    class="text-danger"> *</span></label>
                                            <input type="text" class="form-control @error('penulis_buku') is-invalid @enderror" id="penulis_buku" name="penulis_buku"
                                                value="{{ old('penulis_buku') }}" placeholder="Masukkan Penulis Buku" autocomplete="off">
                                            @error('penulis_buku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="penerbit_buku">Penerbit Buku<span
                                                    class="text-danger"> *</span></label>
                                            <input type="text" class="form-control @error('penerbit_buku') is-invalid @enderror" id="penerbit_buku" name="penerbit_buku"
                                                value="{{ old('penerbit_buku') }}" placeholder="Masukkan Penerbit Buku" autocomplete="off">
                                            @error('penerbit_buku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="tahunterbit_buku">Tahun Terbit<span
                                                    class="text-danger"> *</span></label>
                                            <input class="form-control @error('tahunterbit_buku') is-invalid @enderror"
                                                name="tahunterbit_buku" type="number" value="{{ old('tahunterbit_buku') }}"
                                                autocomplete="off" placeholder="Masukkan Tahun Terbit">
                                            @error('tahunterbit_buku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="sinopsis_buku">Sinopsis Buku<span
                                                    class="text-danger"> *</span></label>
                                            <textarea class="form-control @error('sinopsis_buku') is-invalid @enderror"
                                                name="sinopsis_buku" autocomplete="off" placeholder="Masukkan Sinopsis Buku"
                                            >{{ old('sinopsis_buku') }}</textarea>
                                            @error('sinopsis_buku')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="sampul_buku">Sampul Buku
                                                <span class="text-danger">(JPG, PNG, MAX:1MB) *</span>
                                            </label>
                                            <div class="upload-container">
                                                <div class="row d-flex">
                                                    <div class="col-2">
                                                        <div class="upload-area">
                                                            <div class="upload-icon text-center">
                                                                <div style="font-size: 12px;">Max: 1 file <br></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-10 mt-4">
                                                        <input type="file" class="file-input form-control @error('sampul_buku') is-invalid @enderror" name="sampul_buku" accept=".jpg,.png,.jpeg"
                                                            value="{{ old('sampul_buku') }}">
                                                        @error('sampul_buku')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="file-info" style="display: none;"></div>
                                            </div>
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

@push('style')
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
@endpush

@push('script')
    <script src="{{ asset('js/addHero.js') }}"></script>
    <script src="{{ asset('js/noEnter.js') }}"></script>
@endpush