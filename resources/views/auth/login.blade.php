<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('ui.auth.login_title') }} — {{ config('company.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body class="login-page">
    <div class="login-card login-card--wide">
        <div class="admin-brand">
            <span class="mark">{{ __('ui.brand.mark') }}</span>
            <span>
                <strong>{{ __('ui.auth.login_title') }}</strong>
                <small>{{ config('company.short_name') }}</small>
            </span>
        </div>

        <p>{{ __('ui.auth.login_lead') }}</p>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="login-options">
            <section class="login-option">
                <h2>{{ __('ui.auth.option_admin') }}</h2>
                <p class="login-option-lead">{{ __('ui.auth.option_admin_lead') }}</p>

                <form class="form-grid" method="POST" action="{{ route('login.attempt') }}">
                    @csrf

                    <div class="field">
                        <label for="email">{{ __('ui.auth.email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="field">
                        <label for="password">{{ __('ui.auth.password') }}</label>
                        <input id="password" type="password" name="password" required>
                    </div>

                    <label class="checkbox">
                        <input type="checkbox" name="remember" value="1">
                        <span>{{ __('ui.auth.remember') }}</span>
                    </label>

                    <button class="btn btn-primary btn-block" type="submit">{{ __('ui.auth.login') }}</button>
                </form>
            </section>

            <section class="login-option">
                <h2>{{ __('ui.auth.option_google') }}</h2>
                <p class="login-option-lead">{{ __('ui.auth.option_google_lead') }}</p>

                <a class="btn btn-outline btn-block" href="{{ route('auth.google.redirect') }}">
                    {{ __('ui.auth.login_google') }}
                </a>

                @unless ($googleEnabled)
                    <span class="hint">{{ __('ui.auth.google_config_hint') }}</span>
                @endunless
            </section>

            <section class="login-option">
                <h2>{{ __('ui.auth.option_guest') }}</h2>
                <p class="login-option-lead">{{ __('ui.auth.option_guest_lead') }}</p>

                <form method="POST" action="{{ route('login.guest') }}">
                    @csrf
                    <button class="btn btn-ghost btn-block" type="submit">{{ __('ui.auth.login_guest') }}</button>
                </form>
            </section>
        </div>

        <div class="login-hint">
            Demo admin: <strong>admin@nusadeterminan.co.id</strong> / <strong>password</strong>
        </div>

        <div class="login-foot">
            <a href="{{ route('register') }}">{{ __('ui.auth.register_link') }}</a>
            <a href="{{ route('home') }}">{{ __('ui.auth.back_home') }}</a>
        </div>
    </div>

    <script src="{{ asset('assets/js/password-toggle.js') }}" defer></script>
</body>
</html>
