<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="{{ asset('assets/siberta/logo-siberta-light.svg') }}" alt="logo-siberta">
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                @foreach (config('navbar') as $navbar)
                    <li><a href="{{ $navbar['link'] }}" class="{{ $navbar['status'] == 'active' ? 'active' : '' }}">{{ $navbar['name'] }}</a></li>
                    @if ($navbar['button'])
                        <li><a class="get-a-quote" href="{{ $navbar['link'] }}">{{ $navbar['name'] }}</a></li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</header>
