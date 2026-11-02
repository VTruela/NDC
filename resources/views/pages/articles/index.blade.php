@extends('layouts.app')

@section('title', __('ui.articles.title'))

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
                <span class="sep">/</span>
                <span>{{ __('ui.nav.articles') }}</span>
            </nav>
            <h1>{{ __('ui.articles.title') }}</h1>
            <p class="lead">{{ __('ui.articles.lead') }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container layout-sidebar">
            <div>
                @if ($articles->isEmpty())
                    <div class="empty-state">{{ __('ui.articles.empty') }}</div>
                @else
                    <div class="grid grid-2">
                        @foreach ($articles as $article)
                            @include('partials.article-card', ['article' => $article])
                        @endforeach
                    </div>

                    <div class="pagination-wrap">
                        {{ $articles->links() }}
                    </div>
                @endif
            </div>

            <aside>
                <div class="sidebar-card">
                    <h3>{{ __('ui.articles.latest') }}</h3>
                    <ul class="sidebar-list">
                        @foreach ($latest as $item)
                            <li>
                                <a href="{{ route('articles.show', $item->slug) }}">{{ $item->title }}</a>
                                <small>{{ $item->published_at?->translatedFormat('d M Y') }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>

    @include('partials.cta')
@endsection
