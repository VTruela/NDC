@extends('layouts.app')

@section('title', $category->localized_name)
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
                <span>{{ $category->localized_name }}</span>
            </nav>
            <span class="kicker">{{ __('ui.common.category') }}</span>
            <h1>{{ $category->localized_name }}</h1>
            <p class="lead">
                {{ $category->description ?: __('ui.products.category_lead', ['category' => $category->localized_name]) }}
            </p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="filter-bar" aria-label="{{ __('ui.products.filter_label') }}">
                <a class="filter-pill" href="{{ route('products.index') }}">{{ __('ui.common.all') }}</a>
                @foreach ($categories as $item)
                    <a class="filter-pill {{ $item->id === $category->id ? 'is-active' : '' }}"
                       href="{{ route('products.category', $item) }}">
                        {{ $item->localized_name }}
                    </a>
                @endforeach
            </div>

            @if ($products->isEmpty())
                <div class="empty-state">{{ __('ui.products.empty') }}</div>
            @else
                <div class="grid grid-3">
                    @foreach ($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="pagination-wrap">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </section>

    @include('partials.cta')
@endsection
