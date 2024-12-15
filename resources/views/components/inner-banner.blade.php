<!-- inner page banner -->
<div class="page-banner ovbl-dark" style="background-image:url(assets/images/banner/banner2.jpg);">
    <div class="container">
        <div class="page-banner-entry">
            <h1 class="text-white">@yield('title', 'Smart Wada')</h1>
        </div>
    </div>
</div>
<!-- Breadcrumb row -->
<div class="breadcrumb-row">
    <div class="container">
        <ul class="list-inline">
            <li><a href="{{ url('/') }}">Home</a></li>
            @foreach ($breadcrumbs ?? [] as $breadcrumb)
                <li>
                    @if ($breadcrumb['url'])
                        <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                    @else
                        {{ $breadcrumb['title'] }}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- Breadcrumb row END -->
<!-- inner page banner END -->
