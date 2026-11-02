<div class="testimonial reveal">
    <div class="stars" aria-label="{{ $testimonial->rating }} / 5">
        {{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}
    </div>
    <blockquote>&ldquo;{{ $testimonial->content }}&rdquo;</blockquote>
    <div class="testimonial-author">
        <img src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" loading="lazy">
        <div>
            <strong>{{ $testimonial->name }}</strong>
            <span>{{ $testimonial->company }}</span>
        </div>
    </div>
</div>
