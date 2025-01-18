@extends('layout.user.main')
@section('container')

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('process.ubahPasswordUser', Auth::user()->id_user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset>
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="text-center"><strong>Ubah Password</strong></h2>
                        <div class="row my-3">
                            <div class="col form-group">
                                <label class="form-label" for="new_password">Password Baru
                                    <span class="text-danger"> *</span>
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('new_password') is-invalid @enderror passwordField"
                                        name="new_password" id="new_password"
                                        placeholder="Ulangi Password" minlength="8">
                                    <button type="button" class="btn btn-outline-info togglePassword">
                                        <iconify-icon icon="tabler:eye-off" class="fs-6"></iconify-icon>
                                    </button>
                                </div>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-3">
                            <div class="col form-group">
                                <label class="form-label" for="new_password_confirmation">Ulangi Password
                                    Baru<span class="text-danger"> *</span></label>
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('new_password_confirmation') is-invalid @enderror passwordField"
                                        name="new_password_confirmation" id="new_password_confirmation"
                                        placeholder="Ulangi Password" minlength="8">
                                    <button type="button" class="btn btn-outline-info togglePassword">
                                        <iconify-icon icon="tabler:eye-off" class="fs-6"></iconify-icon>
                                    </button>
                                </div>
                                @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center text-md-start">
                            <button type="submit" class="btn btn-info my-3 w-100" style="width: 100%;">
                                Ubah
                            </button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('js/viewPassword.js') }}"></script>
@endpush