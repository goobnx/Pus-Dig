<nav aria-label="breadcrumb" class="d-flex align-items-center mb-3">
    <h1 class="text-dark fw-bolder fs-6 mb-0">
        {{ $judulHalaman ?? 'Judul Halaman' }}
    </h1>
    <div class="vr mx-2" style="height: 20px;"></div>
    <ol class="breadcrumb mb-0">
        @foreach($breadcrumbs as $breadcrumb)
            @if($breadcrumb['url'] !== '')
                <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
            @else
                <li class="breadcrumb-item @if($loop->last) active @endif" aria-current="page">
                    {{ $breadcrumb['label'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>

