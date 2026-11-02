@extends('layouts.app')

@section('title', __('ui.products.title'))

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
                <span class="sep">/</span>
                <span>{{ __('ui.nav.products') }}</span>
            </nav>
            <h1>{{ __('ui.products.title') }}</h1>
            <p class="lead">{{ __('ui.products.lead') }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="filter-bar" aria-label="{{ __('ui.products.filter_label') }}">
                <a class="filter-pill is-active" href="{{ route('products.index') }}">{{ __('ui.common.all') }}</a>
                @foreach ($categories as $category)
                    <a class="filter-pill" href="{{ route('products.category', $category) }}">
                        {{ $category->localized_name }}
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
