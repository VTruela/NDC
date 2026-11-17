<section class="cta-band">
    <div class="cta-shapes" aria-hidden="true">
        <span class="cta-orb cta-orb-1"></span>
        <span class="cta-orb cta-orb-2"></span>
    </div>
    <div class="container cta-inner reveal">
        <div>
            <span class="cta-kicker">✦ {{ config('company.name') }}</span>
            <h2 class="mb-0">{{ $title ?? __('ui.home.cta_title') }}</h2>
            <p>{{ $text ?? __('ui.home.cta_text') }}</p>
        </div>
        <a class="btn btn-light btn-glow magnetic-btn" href="{{ route('contact.index') }}">
            <span>{{ __('ui.home.cta_button') }}</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
    </div>
</section>
