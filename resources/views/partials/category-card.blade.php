<article class="card card-category tilt-card reveal theme-card-{{ $category->theme ?? 'default' }}">
    <a class="card-media" href="{{ route('products.category', $category) }}">
        <img src="{{ $category->image_url }}" alt="{{ $category->localized_name }}" loading="lazy">
        <span class="badge badge-glass media-tag">
            {{ __('ui.common.products_count', ['count' => $category->products_count ?? $category->products()->count()]) }}
        </span>
    </a>
    <div class="card-body">
        <h3 class="card-title">
            <a href="{{ route('products.category', $category) }}">{{ $category->localized_name }}</a>
        </h3>
        <p class="card-text">{{ $category->description }}</p>
        <div class="card-foot">
            <span class="category-chip">{{ $category->localized_name }}</span>
            <a class="text-link" href="{{ route('products.category', $category) }}">{{ __('ui.common.view_all') }}</a>
        </div>
    </div>
</article>
