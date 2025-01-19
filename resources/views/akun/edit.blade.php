@extends('layout.main')
@section('container')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    @include('partials.breadcrumb.breadcrumb', ['pageTitle' => $judulHalaman, 'breadcrumbs' => $breadcrumbs,])
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('akun.update', $user->id_user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <h2 class="text-center"><strong>Ubah Akun</strong></h2>
                                    </div>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="username">Username<span class="text-danger">
                                                    *</span></label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                                id="username" name="username" value="{{ old('username', $user->username) }}"
                                                placeholder="Masukkan Username" disabled>
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="email">Email<span class="text-danger">
                                                    *</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}"
                                                placeholder="Masukkan Email" disabled>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="alamat">Alamat<span
                                                    class="text-danger"> *</span></label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                                placeholder="Masukkan Alamat" disabled>{{ old('alamat', $user->alamat) }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col my-3">
                                            <label class="form-label" for="role">Role<span class="text-danger"> *</span></label>
                                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                                <option value="" disabled {{ old('role', $user->role ?? '') == '' ? 'selected' : '' }}>Pilih Role</option>
                                                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="petugas" {{ old('role', $user->role ?? '') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                                <option value="peminjam" {{ old('role', $user->role ?? '') == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                                            </select>
                                            @error('role')
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

@push('script')
    <script src="{{ asset('js/viewPassword.js') }}"></script>
@endpush