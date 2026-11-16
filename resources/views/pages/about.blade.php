@extends('layouts.app')

@section('title', __('ui.nav.about'))

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
                <span class="sep">/</span>
                <span>{{ __('ui.nav.about') }}</span>
            </nav>
            <span class="kicker">{{ __('ui.about.kicker') }}</span>
            <h1>{{ __('ui.about.title') }}</h1>
            <p class="lead">{{ __('ui.about.lead') }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container detail-grid">
            <div>
                <span class="kicker">{{ __('ui.about.story_kicker') }}</span>
                <h2>{{ __('ui.about.story_title') }}</h2>
                <p>{{ __('ui.about.story_1') }}</p>
                <p>{{ __('ui.about.story_2') }}</p>
            </div>
            <div class="detail-media">
                <img src="{{ \App\Support\Media::aboutUrl() }}"
                     alt="{{ config('company.name') }}">
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="container">
            <div class="grid grid-2">
                <div class="info-card">
                    <h3>{{ __('ui.about.vision_title') }}</h3>
                    <p>{{ __('ui.about.vision_text') }}</p>
                </div>
                <div class="info-card">
                    <h3>{{ __('ui.about.mission_title') }}</h3>
                    <ul class="spec-list">
                        <li>{{ __('ui.about.mission_1') }}</li>
                        <li>{{ __('ui.about.mission_2') }}</li>
                        <li>{{ __('ui.about.mission_3') }}</li>
                    </ul>
                </div>
            </div>

            <h2 class="mt-xl">{{ __('ui.about.values_title') }}</h2>
            <div class="grid grid-4">
                @foreach ([1, 2, 3, 4] as $index)
                    <div class="feature reveal">
                        <div class="feature-icon">{{ $index }}</div>
                        <h3>{{ __('ui.about.value_' . $index) }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <span class="kicker">{{ __('ui.about.cert_title') }}</span>
                <h2>{{ __('ui.about.capability_title') }}</h2>
                <p class="lead">{{ __('ui.about.cert_text') }}</p>
            </div>

            <ul class="spec-list">
                <li>{{ __('ui.about.capability_1') }}</li>
                <li>{{ __('ui.about.capability_2') }}</li>
                <li>{{ __('ui.about.capability_3') }}</li>
                <li>{{ __('ui.about.capability_4') }}</li>
            </ul>
        </div>
    </section>

    @if ($categories->isNotEmpty())
        <section class="section section-alt">
            <div class="container">
                <div class="section-head">
                    <span class="kicker">{{ __('ui.home.categories_kicker') }}</span>
                    <h2>{{ __('ui.home.categories_title') }}</h2>
                </div>
                <div class="grid grid-3">
                    @foreach ($categories as $category)
                        @include('partials.category-card', ['category' => $category])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($testimonials->isNotEmpty())
        <section class="section">
            <div class="container">
                <div class="grid grid-3">
                    @foreach ($testimonials as $testimonial)
                        @include('partials.testimonial-card', ['testimonial' => $testimonial])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.cta', ['title' => __('ui.about.cta_title'), 'text' => __('ui.about.cta_text')])
@endsection
