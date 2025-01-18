@if (session('success'))
    <script>
        console.log('Session success: {{ session('success') }}');
        Swal.fire({
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        icon: 'success',
        timer: 2500,
        showConfirmButton: false
    });
    </script>
@endif

@if (session('info'))
    <script>
        console.log('Session info: {{ session('info') }}');
        Swal.fire({
        title: 'Info!',
        text: '{{ session('info') }}',
        icon: 'info',
        timer: 2500,
        showConfirmButton: false
    });
    </script>
@endif