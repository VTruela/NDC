<section class="cta-band">
    <div class="container cta-inner">
        <div>
            <h2 class="mb-0">{{ $title ?? __('ui.home.cta_title') }}</h2>
            <p>{{ $text ?? __('ui.home.cta_text') }}</p>
        </div>
        <a class="btn btn-light" href="{{ route('contact.index') }}">{{ __('ui.home.cta_button') }}</a>
    </div>
</section>
