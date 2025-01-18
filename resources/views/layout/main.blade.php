<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perpustakaan Digital</title>
    
    <link rel="icon" href="{{ asset('img/logos/icon-title.png') }}">

    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('libs/simplebar/dist/simplebar.min.css') }}">

    @stack('style')

</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('layout.sidebar')

        <div class="body-wrapper">

            @include('layout.header')
            @include('partials.modal_logout')

            @yield('container')

        </div>
    </div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>

    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>

    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/dashboard/sidebarmenu.js') }}"></script>

    <script src="{{ asset('js/dashboard/app.min.js') }}"></script>

    <script src="{{ asset('demo/datatables-demo.js') }}"></script>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/set-alert.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @include('partials.sweet_alert.swal')

    @stack('script')

</body>
</html>