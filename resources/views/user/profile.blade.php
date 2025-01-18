@extends('layout.user.main')
@section('container')

<div class="row">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Informasi Akun</h2>
                    </div>

                    <form action="{{ route('profilUser.update', Auth::user()->id_user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row my-4">
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <div id="profileImageContainer">
                                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('img/profile/user-1.jpg') }}"
                                        alt="Foto Profil" class="rounded-circle" id="file-preview"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-md-8 d-flex flex-column justify-content-center">
                                <div class="upload-container">
                                    <div class="row d-flex">
                                        <div class="mt-5 mt-md-0">
                                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                                id="file-upload" name="photo" accept=".jpg, .jpeg, .png">
                                            @error('photo')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label">Username</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                                    value="{{ old('username', Auth::user()->username) }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                            <div class="col-md-8">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" 
                                    name="alamat">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="created_at" class="col-md-4 col-form-label">Akun Dibuat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="created_at" disabled
                                    value="{{ Auth::user()->created_at->format('d M Y H:i') }}">
                                <div class="form-text text-danger fw-bold">Data ini tidak bisa diubah</div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-warning">Perbarui Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        const input = document.getElementById('file-upload');
        const previewPhoto = () => {
            const file = input.files[0];
            if (file) {
                const fileReader = new FileReader();
                const preview = document.getElementById('file-preview');
                fileReader.onload = function(event) {
                    preview.setAttribute('src', event.target.result);
                }
                fileReader.readAsDataURL(file);
            }
        }
        input.addEventListener("change", previewPhoto);
    </script>
@endpush