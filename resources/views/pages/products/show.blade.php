@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->short_description)
@section('body_class', $category->themeClass())

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/categories/' . $category->theme . '.css') }}">
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
                <span class="sep">/</span>
                <a href="{{ route('products.index') }}">{{ __('ui.nav.products') }}</a>
                <span class="sep">/</span>
                <a href="{{ route('products.category', $category) }}">{{ $category->localized_name }}</a>
                <span class="sep">/</span>
                <span>{{ $product->name }}</span>
            </nav>
            <span class="badge badge-soft">{{ $category->localized_name }}</span>
            <h1 class="mt-0">{{ $product->name }}</h1>
            <p class="lead">{{ $product->short_description }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container detail-grid">
            <div class="detail-media">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
            </div>

            <div>
                <h2>{{ __('ui.products.overview') }}</h2>
                <p>{{ $product->description }}</p>

                <div class="price-note">
                    <span class="badge badge-soft">{{ __('ui.products.specification') }}</span>
                    @if ($product->is_featured)
                        <span class="badge badge-featured">{{ __('ui.products.featured') }}</span>
                    @endif
                </div>

                <div class="info-box">{{ __('ui.products.spec_note') }}</div>

                <div class="hero-actions">
                    <a class="btn btn-primary" href="{{ route('contact.index') }}">{{ __('ui.products.request_quote') }}</a>
                    <a class="btn btn-outline" href="{{ route('products.category', $category) }}">{{ __('ui.products.back') }}</a>
                </div>
            </div>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="section section-alt">
            <div class="container">
                <div class="section-head">
                    <h2>{{ __('ui.products.related') }}</h2>
                </div>
                <div class="grid grid-3">
                    @foreach ($related as $item)
                        @include('partials.product-card', ['product' => $item])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('partials.cta')
@endsection
