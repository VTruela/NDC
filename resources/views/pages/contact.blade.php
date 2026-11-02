@extends('layouts.app')

@section('title', __('ui.contact.title'))

@section('content')
    @php($company = config('company'))

    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('ui.nav.home') }}</a>
                <span class="sep">/</span>
                <span>{{ __('ui.nav.contact') }}</span>
            </nav>
            <h1>{{ __('ui.contact.title') }}</h1>
            <p class="lead">{{ __('ui.contact.lead') }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container contact-grid">
            <div class="form-panel">
                <h2>{{ __('ui.contact.form_title') }}</h2>

                <form class="form-grid" method="POST" action="{{ route('contact.send') }}">
                    @csrf

                    <div class="form-row">
                        <div class="field">
                            <label for="name">{{ __('ui.contact.name') }}</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                            @error('name')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="field">
                            <label for="email">{{ __('ui.contact.email') }}</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="field">
                            <label for="phone">{{ __('ui.contact.phone') }} <span class="hint">({{ __('ui.common.optional') }})</span></label>
                            <input id="phone" type="text" name="phone" value="{{ old('phone') }}">
                            @error('phone')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="field">
                            <label for="subject">{{ __('ui.contact.subject') }}</label>
                            <select id="subject" name="subject">
                                <option value="">{{ __('ui.common.all') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->localized_name }}" @selected(old('subject') === $category->localized_name)>
                                        {{ $category->localized_name }}
                                    </option>
                                @endforeach
                                <option value="Kerja Sama" @selected(old('subject') === 'Kerja Sama')>Kerja Sama</option>
                                <option value="Lainnya" @selected(old('subject') === 'Lainnya')>Lainnya</option>
                            </select>
                            @error('subject')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="message">{{ __('ui.contact.message') }}</label>
                        <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                        @error('message')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <button class="btn btn-primary" type="submit">{{ __('ui.contact.submit') }}</button>
                    </div>
                </form>
            </div>

            <div>
                <h2>{{ __('ui.contact.info_title') }}</h2>

                <div class="info-card">
                    <h3>{{ __('ui.contact.office') }}</h3>
                    <p class="highlight">{{ $company['name'] }}</p>
                    <p>{{ $company['address'] }}</p>
                </div>

                <div class="info-card">
                    <h3>Telepon &amp; Email</h3>
                    <p>{{ $company['phone'] }}</p>
                    <p>WhatsApp: {{ $company['whatsapp'] }}</p>
                    <p>{{ $company['email'] }}</p>
                </div>

                <div class="info-card">
                    <h3>{{ __('ui.contact.hours') }}</h3>
                    <p>{{ $company['hours']['weekday'] }}</p>
                    <p>{{ $company['hours']['weekend'] }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="container">
            <div class="section-head">
                <h2>{{ __('ui.contact.faq_title') }}</h2>
            </div>

            <details class="faq-item" open>
                <summary>{{ __('ui.contact.faq_1_q') }}</summary>
                <p>{{ __('ui.contact.faq_1_a') }}</p>
            </details>
            <details class="faq-item">
                <summary>{{ __('ui.contact.faq_2_q') }}</summary>
                <p>{{ __('ui.contact.faq_2_a') }}</p>
            </details>
            <details class="faq-item">
                <summary>{{ __('ui.contact.faq_3_q') }}</summary>
                <p>{{ __('ui.contact.faq_3_a') }}</p>
            </details>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>{{ __('ui.contact.map_title') }}</h2>
            </div>
            <div class="map-frame">
                <iframe
                    title="{{ __('ui.contact.map_title') }}"
                    loading="lazy"
                    src="https://www.openstreetmap.org/export/embed.html?bbox=106.877%2C-6.213%2C106.917%2C-6.183&amp;layer=mapnik">
                </iframe>
            </div>
        </div>
    </section>
@endsection
