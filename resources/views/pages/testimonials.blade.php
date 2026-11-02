@extends('layouts.app')

@section('title', __('ui.testimonials.title'))

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
                <span class="sep">/</span>
                <span>{{ __('ui.nav.testimonials') }}</span>
            </nav>
            <h1>{{ __('ui.testimonials.title') }}</h1>
            <p class="lead">{{ __('ui.testimonials.lead') }}</p>

            @if ($testimonials->isNotEmpty())
                <div class="rating-summary mt-lg">
                    <strong>{{ number_format($averageRating, 1) }}</strong>
                    <div>
                        <div class="stars">{{ str_repeat('★', (int) round($averageRating)) }}</div>
                        <small>{{ __('ui.testimonials.average') }} &middot; {{ __('ui.testimonials.from', ['count' => $testimonials->count()]) }}</small>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="section">
        <div class="container">
            @if ($testimonials->isEmpty())
                <div class="empty-state">{{ __('ui.testimonials.empty') }}</div>
            @else
                <div class="grid grid-3">
                    @foreach ($testimonials as $testimonial)
                        @include('partials.testimonial-card', ['testimonial' => $testimonial])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @include('partials.cta')
@endsection
