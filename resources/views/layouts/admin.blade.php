<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('ui.admin.dashboard')) — {{ __('ui.admin.title') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body>
    @php($unread = \App\Models\ContactMessage::unread()->count())

    <div class="admin-shell">
        <aside class="admin-sidebar" id="adminSidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ \App\Support\Media::logoUrl() }}" alt="Logo" style="width:38px;height:38px;border-radius:10px;object-fit:contain">
                <span>
                    <strong>{{ __('ui.admin.title') }}</strong>
                    <small>{{ __('ui.brand.name') }}</small>
                </span>
            </a>

            @php($me = auth()->user())

            <nav>
                <div class="admin-nav-group">
                    <span>{{ __('ui.admin.menu_management') }}</span>
                    <a class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        {{ __('ui.admin.dashboard') }}
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.contacts.*') ? 'is-active' : '' }}"
                       href="{{ route('admin.contacts.index') }}">
                        {{ __('ui.admin.contacts') }}
                        @if ($unread > 0)
                            <span class="count">{{ $unread }}</span>
                        @endif
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.texts.*') ? 'is-active' : '' }}"
                       href="{{ route('admin.texts.index') }}">
                        {{ __('ui.admin.texts') }}
                    </a>
                </div>

                <div class="admin-nav-group">
                    <span>{{ __('ui.admin.menu_content') }}</span>
                    <a class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'is-active' : '' }}"
                       href="{{ route('admin.categories.index') }}">
                        {{ __('ui.admin.categories') }}
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}"
                       href="{{ route('admin.products.index') }}">
                        {{ __('ui.admin.products') }}
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.articles.*') ? 'is-active' : '' }}"
                       href="{{ route('admin.articles.index') }}">
                        {{ __('ui.admin.articles') }}
                    </a>
                    <a class="admin-nav-link {{ request()->routeIs('admin.testimonials.*') ? 'is-active' : '' }}"
                       href="{{ route('admin.testimonials.index') }}">
                        {{ __('ui.admin.testimonials') }}
                    </a>
                </div>
            </nav>

            @if ($me)
                <div class="admin-user">
                    <strong>{{ $me->name }}</strong>
                    <span>{{ $me->email }}</span>
                    <span class="admin-role">{{ $me->roleLabel() }}</span>
                </div>
            @endif
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <div class="title-group">
                    <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Menu">&#9776;</button>
                    <div>
                        <h1>@yield('heading', __('ui.admin.dashboard'))</h1>
                        <div class="crumb">@yield('crumb', __('ui.admin.title'))</div>
                    </div>
                </div>

                <div class="topbar-actions">
                    <a class="btn btn-outline btn-sm" href="{{ route('home') }}" target="_blank" rel="noopener">
                        {{ __('ui.admin.back_to_site') }}
                    </a>
                    <a class="btn btn-sm" href="{{ route('home') }}">
                        {{ __('ui.admin.logout') }}
                    </a>
                </div>
            </header>

            <div class="admin-content">
                @if (session('success'))
                    <div class="alert alert-success" role="status">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="alert-close" aria-label="Close">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <span>{{ session('error') }}</span>
                        <button type="button" class="alert-close" aria-label="Close">&times;</button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/admin.js') }}" defer></script>
    <script src="{{ asset('assets/js/password-toggle.js') }}" defer></script>
</body>
</html>
