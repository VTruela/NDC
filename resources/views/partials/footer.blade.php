@php($company = config('company'))

<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-col footer-about">
            <a class="brand brand-light" href="{{ route('home') }}">
                <img src="{{ \App\Support\Media::logoUrl() }}" alt="{{ __('ui.brand.name') }}" style="width:42px;height:42px;border-radius:12px;object-fit:contain">
                <span class="brand-text">
                    <strong>{{ __('ui.brand.name') }}</strong>
                    <small>{{ __('ui.brand.suffix') }}</small>
                </span>
            </a>
            <p>{{ __('ui.brand.description') }}</p>
            <div class="social-row">
                <a href="{{ $company['socials']['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn">in</a>
                <a href="{{ $company['socials']['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram">ig</a>
                <a href="{{ $company['socials']['youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube">yt</a>
            </div>
        </div>

        <div class="footer-col">
            <h4>{{ __('ui.footer.quick_links') }}</h4>
            <ul class="footer-links">
                <li><a href="{{ route('about') }}">{{ __('ui.nav.about') }}</a></li>
                <li><a href="{{ route('products.index') }}">{{ __('ui.nav.products') }}</a></li>
                <li><a href="{{ route('articles.index') }}">{{ __('ui.nav.articles') }}</a></li>
                <li><a href="{{ route('testimonials.index') }}">{{ __('ui.nav.testimonials') }}</a></li>
                <li><a href="{{ route('contact.index') }}">{{ __('ui.nav.contact') }}</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>{{ __('ui.footer.product_lines') }}</h4>
            <ul class="footer-links">
                @foreach (\App\Models\Category::orderBy('name')->get() as $category)
                    <li><a href="{{ route('products.category', $category) }}">{{ $category->localized_name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="footer-col">
            <h4>{{ __('ui.footer.contact_title') }}</h4>
            <ul class="footer-contact">
                <li><span class="dot"></span>{{ $company['address'] }}</li>
                <li><span class="dot"></span>{{ $company['phone'] }}</li>
                <li><span class="dot"></span>{{ $company['email'] }}</li>
            </ul>
        </div>
    </div>

    <div class="container footer-bottom">
        <span>&copy; {{ date('Y') }} {{ $company['name'] }}. {{ __('ui.footer.rights') }}</span>
        <span>{{ __('ui.brand.tagline') }}</span>
    </div>
</footer>
