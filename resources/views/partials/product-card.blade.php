@php($category = $product->category)
<article class="card reveal">
    <a class="card-media" href="{{ route('products.show', [$category, $product->slug]) }}">
        @if ($product->is_featured)
            <span class="badge badge-featured media-tag">{{ __('ui.products.featured') }}</span>
        @endif
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
    </a>
    <div class="card-body">
        <span class="badge badge-soft">{{ $category->localized_name }}</span>
        <h3 class="card-title">
            <a href="{{ route('products.show', [$category, $product->slug]) }}">{{ $product->name }}</a>
        </h3>
        <p class="card-text">{{ $product->short_description }}</p>
        <div class="card-foot">
            <span>{{ $category->localized_name }}</span>
            <a class="text-link" href="{{ route('products.show', [$category, $product->slug]) }}">{{ __('ui.common.view_detail') }}</a>
        </div>
    </div>
</article>
