<header class="site-header" id="siteHeader">
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}">
            <span class="brand-mark">ND</span>
            <span class="brand-text">
                <strong>Nusa Determinan</strong>
                <small>Cemerlang</small>
            </span>
        </a>

        <nav class="main-nav" id="mainNav">
            <a class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
            <a class="nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">{{ __('ui.nav.about') }}</a>
            <a class="nav-link {{ request()->routeIs('products.*') ? 'is-active' : '' }}" href="{{ route('products.index') }}">{{ __('ui.nav.products') }}</a>
            <a class="nav-link {{ request()->routeIs('articles.*') ? 'is-active' : '' }}" href="{{ route('articles.index') }}">{{ __('ui.nav.articles') }}</a>
            <a class="nav-link {{ request()->routeIs('testimonials.*') ? 'is-active' : '' }}" href="{{ route('testimonials.index') }}">{{ __('ui.nav.testimonials') }}</a>
            <a class="nav-link {{ request()->routeIs('contact.*') ? 'is-active' : '' }}" href="{{ route('contact.index') }}">{{ __('ui.nav.contact') }}</a>

            <div class="nav-mobile-actions">
                <a class="btn btn-primary btn-block" href="{{ route('contact.index') }}">{{ __('ui.home.hero_cta') }}</a>
                @auth
                    <a class="btn btn-ghost btn-block" href="{{ route('admin.dashboard') }}">{{ __('ui.nav.admin') }}</a>
                @else
                    <a class="btn btn-ghost btn-block" href="{{ route('login') }}">{{ __('ui.auth.login') }}</a>
                @endauth
            </div>
        </nav>

        <div class="header-actions">
            <div class="lang-switch" aria-label="{{ __('ui.common.language') }}">
                <a class="{{ app()->getLocale() === 'id' ? 'is-active' : '' }}" href="{{ route('lang.switch', 'id') }}">ID</a>
                <a class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}" href="{{ route('lang.switch', 'en') }}">EN</a>
            </div>
            @auth
                <a class="nav-link header-login" href="{{ route('admin.dashboard') }}">{{ __('ui.nav.admin') }}</a>
            @else
                <a class="nav-link header-login" href="{{ route('login') }}">{{ __('ui.auth.login') }}</a>
            @endauth
            <a class="btn btn-primary btn-sm header-cta" href="{{ route('contact.index') }}">{{ __('ui.home.hero_cta') }}</a>
            <button class="nav-toggle" id="navToggle" type="button" aria-label="{{ __('ui.nav.menu') }}" aria-expanded="false" aria-controls="mainNav">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
