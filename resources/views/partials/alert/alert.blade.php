@if (session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info" id="info-alert">
        {{ session('info') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning" id="warning-alert">
        {{ session('warning') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" id="error-alert">
        {{ session('error') }}
    </div>
@endif