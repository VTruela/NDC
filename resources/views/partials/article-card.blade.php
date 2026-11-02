<article class="card reveal">
    <a class="card-media" href="{{ route('articles.show', $article->slug) }}">
        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy">
    </a>
    <div class="card-body">
        <span class="badge badge-soft">{{ $article->published_at?->translatedFormat('d M Y') }}</span>
        <h3 class="card-title">
            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
        </h3>
        <p class="card-text">{{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 140) }}</p>
        <div class="card-foot">
            <span>{{ __('ui.common.minute_read', ['count' => $article->reading_time]) }}</span>
            <a class="text-link" href="{{ route('articles.show', $article->slug) }}">{{ __('ui.articles.read_more') }}</a>
        </div>
    </div>
</article>
