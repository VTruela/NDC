@php($item = $testimonial ?? $t ?? null)
@if ($item)
<article class="testimonial reveal">
    <div class="stars" aria-label="{{ $item->rating }} / 5">
        {{ str_repeat('★', (int) $item->rating) }}{{ str_repeat('☆', max(0, 5 - (int) $item->rating)) }}
    </div>
    <blockquote>“{{ $item->content }}”</blockquote>
    <div class="testimonial-author">
        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" loading="lazy">
        <div>
            <strong>{{ $item->name }}</strong>
            <span>{{ $item->company }}</span>
        </div>
    </div>
</article>
@endif
