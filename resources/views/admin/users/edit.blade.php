@extends('layouts.admin')

@section('title', __('ui.admin.edit_user'))
@section('heading', __('ui.admin.edit_user'))
@section('crumb', __('ui.admin.users'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.edit_user') }}</h2>
            <a class="btn btn-outline btn-sm" href="{{ route('admin.users.index') }}">{{ __('ui.admin.back') }}</a>
        </div>

        <div class="panel-body">
            <form class="form-grid" method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="field">
                        <label for="name">{{ __('ui.admin.field_name') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label for="email">{{ __('ui.admin.field_email') }}</label>
                        <input id="email" type="email" value="{{ $user->email }}" readonly>
                    </div>
                </div>

                <div class="field">
                    <label for="role">{{ __('ui.admin.field_role') }}</label>
                    <select id="role" name="role" required>
                        @foreach (\App\Models\User::ROLES as $value => $label)
                            <option value="{{ $value }}" @selected(old('role', $user->role) === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <span class="hint">{{ __('ui.admin.field_role_hint') }}</span>
                    @error('role')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">{{ __('ui.admin.save') }}</button>
                    <a class="btn btn-outline" href="{{ route('admin.users.index') }}">{{ __('ui.admin.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
@endsection
