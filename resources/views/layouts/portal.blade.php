<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'All-in-One Business Portal')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/portal.css') }}">
</head>

<body>
    @php
        $navItems = [
            ['label' => 'Home', 'route' => 'home', 'match' => 'home'],
            ['label' => 'Employees', 'route' => 'employees.index', 'match' => 'employees.*'],
            ['label' => 'Products', 'route' => 'products.index', 'match' => 'products.*'],
            ['label' => 'Gallery', 'route' => 'gallery.index', 'match' => 'gallery.*'],
            ['label' => 'News', 'route' => 'news.index', 'match' => 'news.*'],
        ];
    @endphp

    <div class="site-shell">
        <nav class="portfolio-nav">
            <a class="portfolio-brand" href="{{ route('home') }}">
                <span class="brand-orbit">A1</span>
                <span>
                    <strong>All-in-One</strong>
                    <small>Business Portal</small>
                </span>
            </a>

            <div class="portfolio-links">
                @foreach ($navItems as $item)
                    <a class="{{ request()->routeIs($item['match']) ? 'active' : '' }}"
                        href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
                @endforeach
            </div>

            <a class="nav-cta {{ request()->routeIs('contact.*') ? 'active' : '' }}"
                href="{{ route('contact.index') }}">Contact</a>

            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav"
                aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <div class="collapse mobile-nav" id="mobileNav">
            @foreach ($navItems as $item)
                <a class="{{ request()->routeIs($item['match']) ? 'active' : '' }}"
                    href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
            @endforeach
            <a class="{{ request()->routeIs('contact.*') ? 'active' : '' }}"
                href="{{ route('contact.index') }}">Contact</a>
        </div>

        <main class="workspace">
            @yield('content')
        </main>

        <footer class="portal-footer">
            <div class="footer-inner">
                <div class="footer-intro">
                    <a class="footer-brand" href="{{ route('home') }}">
                        <span class="brand-orbit">A1</span>
                        <span>
                            <strong>All-in-One</strong>
                            <small>Business Portal</small>
                        </span>
                    </a>
                    <p>Employees, catalog records, media, and updates in one practical workspace.</p>
                    <div class="footer-social" aria-label="Social links">
                        <a href="#" aria-label="GitHub">GH</a>
                        <a href="#" aria-label="X">X</a>
                        <a href="#" aria-label="YouTube">YT</a>
                        <a href="#" aria-label="Community">CM</a>
                    </div>
                </div>

                <nav class="footer-columns" aria-label="Footer navigation">
                    <div>
                        <h2>Workspace</h2>
                        <a href="{{ route('home') }}">Overview</a>
                        <a href="{{ route('employees.index') }}">Employees</a>
                        <a href="{{ route('products.index') }}">Products</a>
                        <a href="{{ route('gallery.index') }}">Gallery</a>
                    </div>
                    <div>
                        <h2>Operations</h2>
                        <a href="{{ route('news.index') }}">Notice board</a>
                        <a href="{{ route('contact.index') }}">Contact desk</a>
                        <a href="{{ route('products.index') }}">Catalog API</a>
                        <a href="{{ route('employees.index') }}">Directory</a>
                    </div>
                    <div>
                        <h2>Company</h2>
                        <a href="{{ route('news.index') }}">Updates</a>
                        <a href="{{ route('contact.index') }}">Support</a>
                        <a href="{{ route('gallery.index') }}">Media</a>
                        <a href="{{ route('home') }}">Status</a>
                    </div>
                </nav>

                <div class="footer-legal">
                    <span>&copy; {{ date('Y') }} Business Portal</span>
                    <a href="{{ route('contact.index') }}">Legal</a>
                    <a href="{{ route('contact.index') }}">Trust</a>
                    <a href="{{ route('contact.index') }}">Status</a>
                </div>
            </div>

            <div class="footer-mark">Portal </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>