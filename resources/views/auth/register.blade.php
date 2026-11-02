<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('ui.auth.register_title') }} — {{ config('company.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
</head>
<body class="login-page">
    <div class="login-card login-card--wide">
        <div class="admin-brand">
            <span class="mark">ND</span>
            <span>
                <strong>{{ __('ui.auth.register_title') }}</strong>
                <small>{{ config('company.short_name') }}</small>
            </span>
        </div>

        <p>{{ __('ui.auth.register_lead') }}</p>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <div class="register-grid">
            <aside class="register-aside">
                <h2>{{ __('ui.auth.register_aside_title') }}</h2>
                <p>{{ config('company.name') }}</p>

                <ul class="register-points">
                    <li>{{ __('ui.auth.register_point_1') }}</li>
                    <li>{{ __('ui.auth.register_point_2') }}</li>
                    <li>{{ __('ui.auth.register_point_3') }}</li>
                </ul>
            </aside>

            <form class="form-grid register-form" method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="field">
                    <label for="name">{{ __('ui.auth.name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="email">{{ __('ui.auth.email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-row">
                    <div class="field">
                        <label for="password">{{ __('ui.auth.password') }}</label>
                        <input id="password" type="password" name="password" required>
                        @error('password')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label for="password_confirmation">{{ __('ui.auth.password_confirm') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required>
                    </div>
                </div>

                <button class="btn btn-primary btn-block" type="submit">{{ __('ui.auth.register_button') }}</button>
            </form>
        </div>

        <div class="login-foot">
            <a href="{{ route('login') }}">{{ __('ui.auth.login_link') }}</a>
            <a href="{{ route('home') }}">{{ __('ui.auth.back_home') }}</a>
        </div>
    </div>
</body>
</html>
