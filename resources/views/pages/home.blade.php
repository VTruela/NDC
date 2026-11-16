@extends('layouts.app')

@section('title', __('ui.nav.home'))

@section('content')
    <section class="hero">
        <div class="container hero-inner">
            <div>
                <span class="hero-badge">{{ __('ui.home.hero_badge') }}</span>
                <h1>{{ __('ui.home.hero_title') }}</h1>
                <p class="lead hero-lead">{{ __('ui.home.hero_lead') }}</p>

                <div class="hero-actions">
                    <a class="btn btn-primary" href="{{ route('contact.index') }}">{{ __('ui.home.hero_cta') }}</a>
                    <a class="btn btn-outline" href="{{ route('products.index') }}">{{ __('ui.home.hero_secondary') }}</a>
                </div>
            </div>

            <div class="hero-visual">
                <img src="{{ \App\Support\Media::heroUrl() }}"
                     alt="{{ config('company.name') }}">
                <div class="hero-card">
                    <strong>{{ date('Y') - (int) config('company.founded', 2011) }}+</strong>
                    <span>{{ __('ui.home.stat_years') }}</span>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-band">
        <div class="container">
            <div class="grid grid-4">
                <div class="stat">
                    <strong>{{ date('Y') - (int) config('company.founded', 2011) }}+</strong>
                    <span>{{ __('ui.home.stat_years') }}</span>
                </div>
                <div class="stat">
                    <strong>{{ config('company.stat_clients', '320+') }}</strong>
                    <span>{{ __('ui.home.stat_clients') }}</span>
                </div>
                <div class="stat">
                    <strong>{{ \App\Models\Product::count() }}</strong>
                    <span>{{ __('ui.home.stat_products') }}</span>
                </div>
                <div class="stat">
                    <strong>{{ config('company.stat_cities', '24') }}</strong>
                    <span>{{ __('ui.home.stat_cities') }}</span>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head center">
                <span class="kicker">{{ __('ui.home.categories_kicker') }}</span>
                <h2>{{ __('ui.home.categories_title') }}</h2>
                <p class="lead">{{ __('ui.home.categories_lead') }}</p>
            </div>

            <div class="grid grid-3">
                @foreach ($categories as $category)
                    @include('partials.category-card', ['category' => $category])
                @endforeach
            </div>
        </div>
    </section>

    @if ($featuredProducts->isNotEmpty())
        <section class="section section-alt">
            <div class="container">
                <div class="section-head">
                    <span class="kicker">{{ __('ui.home.products_kicker') }}</span>
                    <h2>{{ __('ui.home.products_title') }}</h2>
                    <p class="lead">{{ __('ui.home.products_lead') }}</p>
                </div>

                <div class="grid grid-3">
                    @foreach ($featuredProducts as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="text-center mt-lg">
                    <a class="btn btn-outline" href="{{ route('products.index') }}">{{ __('ui.common.view_all') }}</a>
                </div>
            </div>
        </section>
    @endif

    <section class="section">
        <div class="container">
            <div class="section-head center">
                <span class="kicker">{{ __('ui.home.why_kicker') }}</span>
                <h2>{{ __('ui.home.why_title') }}</h2>
                <p class="lead">{{ __('ui.home.why_lead') }}</p>
            </div>

            <div class="grid grid-4">
                @foreach ([1, 2, 3, 4] as $index)
                    <div class="feature reveal">
                        <div class="feature-icon">{{ $index }}</div>
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
                <div class="section-head">
                    <span class="kicker">{{ __('ui.home.articles_kicker') }}</span>
                    <h2>{{ __('ui.home.articles_title') }}</h2>
                    <p class="lead">{{ __('ui.home.articles_lead') }}</p>
                </div>

                <div class="grid grid-3">
                    @foreach ($articles as $article)
                        @include('partials.article-card', ['article' => $article])
                    @endforeach
                </div>

                <div class="text-center mt-lg">
                    <a class="btn btn-outline" href="{{ route('articles.index') }}">{{ __('ui.common.view_all') }}</a>
                </div>
            </div>
        </section>
    @endif

    @if ($testimonials->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="section-head center">
                    <span class="kicker">{{ __('ui.home.testimonials_kicker') }}</span>
                    <h2>{{ __('ui.home.testimonials_title') }}</h2>
                    <p class="lead">{{ __('ui.home.testimonials_lead') }}</p>
                </div>

                <div class="grid grid-3">
                    @foreach ($testimonials as $testimonial)
                        @include('partials.testimonial-card', ['testimonial' => $testimonial])
                    @endforeach
                </div>

                <div class="text-center mt-lg">
                    <a class="btn btn-outline" href="{{ route('testimonials.index') }}">{{ __('ui.common.view_all') }}</a>
                </div>
            </div>
        </section>
    @endif

    @include('partials.cta')
@endsection
