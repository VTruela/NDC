@extends('layouts.app')

@section('title', __('ui.nav.home'))

@section('content')
    <section class="hero">
        <div class="hero-mesh" aria-hidden="true">
            <span class="mesh-blob blob-primary"></span>
            <span class="mesh-blob blob-secondary"></span>
            <div class="hero-grid-pattern"></div>
        </div>

        <div class="container hero-inner">
            <div class="hero-copy reveal-up">
                <span class="hero-badge">
                    <span class="pulse-dot"></span>
                    {{ __('ui.home.hero_badge') }}
                </span>
                <h1 class="hero-headline">{{ __('ui.home.hero_title') }}</h1>
                <p class="lead hero-lead">{{ __('ui.home.hero_lead') }}</p>

                <div class="hero-actions">
                    <a class="btn btn-primary btn-glow magnetic-btn" href="{{ route('contact.index') }}">
                        <span>{{ __('ui.home.hero_cta') }}</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a class="btn btn-outline magnetic-btn" href="{{ route('products.index') }}">
                        <span>{{ __('ui.home.hero_secondary') }}</span>
                    </a>
                </div>

                <div class="hero-trust-chips">
                    <span class="trust-chip"><i class="chip-dot"></i> ISO &amp; QC Certified</span>
                    <span class="trust-chip"><i class="chip-dot"></i> R&amp;D Formulasi Khusus</span>
                    <span class="trust-chip"><i class="chip-dot"></i> Pengiriman Nasional</span>
                </div>
            </div>

            <div class="hero-visual reveal-scale">
                <div class="hero-image-frame tilt-card">
                    <img src="{{ \App\Support\Media::heroUrl() }}"
                         alt="{{ config('company.name') }}">
                </div>

                <div class="hero-card float-slow">
                    <div class="hero-card-icon">★</div>
                    <div>
                        <strong class="counter-num" data-count="{{ date('Y') - (int) config('company.founded', 2011) }}">{{ date('Y') - (int) config('company.founded', 2011) }}+</strong>
                        <span>{{ __('ui.home.stat_years') }}</span>
                    </div>
                </div>

                <div class="hero-floating-pill float-reverse">
                    <span class="pill-icon">✓</span>
                    <div>
                        <strong>100% Teruji Lab</strong>
                        <small>Standar Industri</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="marquee-band" aria-hidden="true">
        <div class="marquee-track">
            @for ($i = 0; $i < 2; $i++)
                <div class="marquee-group">
                    <span>✦ METAL FINISHING CHEMICALS</span>
                    <span>✦ INSTITUTIONAL &amp; HYGIENE SOLUTIONS</span>
                    <span>✦ COMMERCIAL LAUNDRY CARE</span>
                    <span>✦ CUSTOM INDUSTRIAL FORMULATION</span>
                    <span>✦ ECO-FRIENDLY &amp; LAB TESTED</span>
                    <span>✦ PT NUSA DETERMINAN CEMERLANG</span>
                </div>
            @endfor
        </div>
    </div>

    <section class="stats-band">
        <div class="container">
            <div class="grid grid-4">
                <div class="stat reveal">
                    <strong class="counter-value">{{ date('Y') - (int) config('company.founded', 2011) }}+</strong>
                    <span>{{ __('ui.home.stat_years') }}</span>
                </div>
                <div class="stat reveal">
                    <strong class="counter-value">{{ config('company.stat_clients', '320+') }}</strong>
                    <span>{{ __('ui.home.stat_clients') }}</span>
                </div>
                <div class="stat reveal">
                    <strong class="counter-value">{{ \App\Models\Product::count() }}+</strong>
                    <span>{{ __('ui.home.stat_products') }}</span>
                </div>
                <div class="stat reveal">
                    <strong class="counter-value">{{ config('company.stat_cities', '24') }}</strong>
                    <span>{{ __('ui.home.stat_cities') }}</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head center reveal">
                <span class="kicker">{{ __('ui.home.categories_kicker') }}</span>
                <h2>{{ __('ui.home.categories_title') }}</h2>
                <p class="lead">{{ __('ui.home.categories_lead') }}</p>
            </div>

            <div class="grid grid-3 stagger-grid">
                @foreach ($categories as $category)
                    @include('partials.category-card', ['category' => $category])
                @endforeach
            </div>
        </div>
    </section>

    @if ($featuredProducts->isNotEmpty())
        <section class="section section-alt">
            <div class="container">
                <div class="section-head reveal">
                    <span class="kicker">{{ __('ui.home.products_kicker') }}</span>
                    <h2>{{ __('ui.home.products_title') }}</h2>
                    <p class="lead">{{ __('ui.home.products_lead') }}</p>
                </div>

                <div class="grid grid-3 stagger-grid">
                    @foreach ($featuredProducts as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="text-center mt-lg reveal">
                    <a class="btn btn-outline magnetic-btn" href="{{ route('products.index') }}">
                        <span>{{ __('ui.common.view_all') }}</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <section class="section">
        <div class="container">
            <div class="section-head center reveal">
                <span class="kicker">{{ __('ui.home.why_kicker') }}</span>
                <h2>{{ __('ui.home.why_title') }}</h2>
                <p class="lead">{{ __('ui.home.why_lead') }}</p>
            </div>

            <div class="grid grid-4 stagger-grid">
                @foreach ([1, 2, 3, 4] as $index)
                    <div class="feature tilt-card reveal">
                        <div class="feature-icon">0{{ $index }}</div>
                        <h3>{{ __('ui.home.why_' . $index . '_title') }}</h3>
                        <p>{{ __('ui.home.why_' . $index . '_text') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if ($articles->isNotEmpty())
        <section class="section section-alt">
            <div class="container">
                <div class="section-head reveal">
                    <span class="kicker">{{ __('ui.home.articles_kicker') }}</span>
                    <h2>{{ __('ui.home.articles_title') }}</h2>
                    <p class="lead">{{ __('ui.home.articles_lead') }}</p>
                </div>

                <div class="grid grid-3 stagger-grid">
                    @foreach ($articles as $article)
                        @include('partials.article-card', ['article' => $article])
                    @endforeach
                </div>

                <div class="text-center mt-lg reveal">
                    <a class="btn btn-outline magnetic-btn" href="{{ route('articles.index') }}">
                        <span>{{ __('ui.common.view_all') }}</span>
                    </a>
                </div>
            </div>
        </section>
    @endif

    @if ($testimonials->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section-head center reveal">
                    <span class="kicker">{{ __('ui.home.testimonials_kicker') }}</span>
                    <h2>{{ __('ui.home.testimonials_title') }}</h2>
                    <p class="lead">{{ __('ui.home.testimonials_lead') }}</p>
                </div>

                <div class="grid grid-3 stagger-grid">
                    @foreach ($testimonials as $testimonial)
                        @include('partials.testimonial-card', ['testimonial' => $testimonial])
                    @endforeach
                </div>

                <div class="text-center mt-lg reveal">
                    <a class="btn btn-outline magnetic-btn" href="{{ route('testimonials.index') }}">
                        <span>{{ __('ui.common.view_all') }}</span>
                    </a>
                </div>
            </div>
        </section>
    @endif

    @include('partials.cta')
@endsection
