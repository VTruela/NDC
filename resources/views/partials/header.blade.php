<header class="site-header" id="siteHeader">
    <div class="scroll-progress" id="scrollProgress" aria-hidden="true"></div>
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}">
            @if (config('company.logo') && file_exists(public_path(config('company.logo'))))
                <span class="brand-logo-wrap">
                    <img src="{{ asset(config('company.logo')) }}" alt="{{ __('ui.brand.name') }}">
                </span>
            @elseif (trim(__('ui.brand.mark')) !== '')
                <span class="brand-logo-wrap">
                    <img src="{{ \App\Support\Media::logoUrl() }}" alt="{{ __('ui.brand.name') }}">
                </span>
            @else
                <span class="brand-mark">{{ __('ui.brand.mark') }}</span>
            @endif
            <span class="brand-text">
                <strong>{{ __('ui.brand.name') }}</strong>
                <small>{{ __('ui.brand.suffix') }}</small>
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
            </div>
        </nav>

        <div class="header-actions">
            <div class="lang-switch" aria-label="{{ __('ui.common.language') }}">
                <a class="{{ app()->getLocale() === 'id' ? 'is-active' : '' }}" href="{{ route('lang.switch', 'id') }}">ID</a>
                <a class="{{ app()->getLocale() === 'en' ? 'is-active' : '' }}" href="{{ route('lang.switch', 'en') }}">EN</a>
            </div>
            <a class="btn btn-primary btn-sm header-cta magnetic-btn" href="{{ route('contact.index') }}">
                <span>{{ __('ui.home.hero_cta') }}</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <button class="nav-toggle" id="navToggle" type="button" aria-label="{{ __('ui.nav.menu') }}" aria-expanded="false" aria-controls="mainNav">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
