@extends('layouts.app')

@section('title', $article->title)
@section('meta_description', $article->excerpt)

@section('content')
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
                <span class="sep">/</span>
                <a href="{{ route('articles.index') }}">{{ __('ui.nav.articles') }}</a>
                <span class="sep">/</span>
                <span>{{ $article->title }}</span>
            </nav>
            <h1>{{ $article->title }}</h1>
            <div class="article-meta">
                <span>{{ __('ui.articles.published_on', ['date' => $article->published_at?->translatedFormat('d F Y')]) }}</span>
                @if ($article->author)
                    <span>{{ __('ui.articles.by', ['author' => $article->author]) }}</span>
                @endif
                <span>{{ __('ui.common.minute_read', ['count' => $article->reading_time]) }}</span>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="article-body">
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}">
                {!! $article->content !!}
            </div>

            <div class="text-center mt-lg">
                <a class="btn btn-outline" href="{{ route('articles.index') }}">{{ __('ui.articles.back') }}</a>
            </div>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="section section-alt">
            <div class="container">
                <div class="section-head">
                    <h2>{{ __('ui.articles.related') }}</h2>
                </div>
                <div class="grid grid-3">
                    @foreach ($related as $item)
                        @include('partials.article-card', ['article' => $item])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
