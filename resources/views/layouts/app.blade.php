<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('ui.nav.home')) — {{ config('company.name') }}</title>
    <meta name="description" content="@yield('meta_description', __('ui.brand.description'))">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('styles')
</head>
<body class="@yield('body_class')">
    <div class="cursor-glow" id="cursorGlow" aria-hidden="true"></div>
    <div class="ambient-bg" aria-hidden="true">
        <span class="ambient-orb orb-1"></span>
        <span class="ambient-orb orb-2"></span>
        <span class="ambient-orb orb-3"></span>
    </div>

    <a class="skip-link" href="#main">{{ __('ui.nav.menu') }}</a>

    @include('partials.header')

    <main id="main">
        @if (session('success'))
            <div class="container">
                <div class="alert alert-success" role="status">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="alert-close" aria-label="Close">&times;</button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    @include('partials.footer')

    <button type="button" class="to-top" id="toTop" aria-label="Top">&uarr;</button>

    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
