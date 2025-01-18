<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">
</head>
<body>
    <div class="container pt-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://unindra.ac.id/sites/default/files/2024-03/dsc00960.jpg"
                            alt="login form" class="img-fluid h-100" style="border-radius: 1rem 0 0 1rem; object-fit: cover;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form action="{{ route('process.login') }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <a href="{{ route('index.book') }}">
                                            <img src="{{ asset('img/logos/logo-sidebar.png') }}" class="img-fluid w-50">
                                        </a>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="email">Email<span
                                            class="text-danger"> *</span></label> 
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="Masukkan Email" autocomplete="off">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="password">Password<span
                                            class="text-danger"> *</span></label>  
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan Password">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-info btn-lg btn-block w-100 text-white" type="submit">Login</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="text-muted fs-4 mb-0 fw-bold">Belum punya akun?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Register</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('partials.sweet_alert.swal')

</body>
</html>