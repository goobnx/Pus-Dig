<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perpustakaan Digital</title>
    <link rel="icon" href="{{ asset('img/logos/icon-title.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @stack('style')
</head>
<body>
    <div class="container py-3">
        @include('layout.user.header')
        @include('partials.modal_logout')
        @yield('container')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('partials.sweet_alert.swal')
    @stack('script')
</body>
</html>