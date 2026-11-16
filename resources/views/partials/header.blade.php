<header class="site-header" id="siteHeader">
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}">
            @if (config('company.logo') && file_exists(public_path(config('company.logo'))))
                <img src="{{ asset(config('company.logo')) }}" alt="{{ __('ui.brand.name') }}" style="width:42px;height:42px;border-radius:12px;object-fit:contain;background:#fff">
            @elseif (trim(__('ui.brand.mark')) !== '')
                <img src="{{ \App\Support\Media::logoUrl() }}" alt="{{ __('ui.brand.name') }}" style="width:42px;height:42px;border-radius:12px;object-fit:contain">
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
                @auth
                    @if (auth()->user()->isAdmin())
                        <a class="btn btn-ghost btn-block" href="{{ route('admin.dashboard') }}">{{ __('ui.nav.admin') }}</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-ghost btn-block" type="submit">{{ __('ui.admin.logout') }}</button>
                    </form>
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
                @if (auth()->user()->isAdmin())
                    <a class="nav-link header-login" href="{{ route('admin.dashboard') }}">{{ __('ui.nav.admin') }}</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button class="nav-link header-login" type="submit" style="background:none;border:none;cursor:pointer;font:inherit;padding:0">
                        {{ __('ui.admin.logout') }}
                    </button>
                </form>
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
