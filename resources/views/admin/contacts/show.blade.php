@extends('layouts.admin')

@section('title', __('ui.admin.message_detail'))
@section('heading', __('ui.admin.message_detail'))
@section('crumb', __('ui.admin.menu_management'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.message_detail') }}</h2>
            <a class="btn btn-outline btn-sm" href="{{ route('admin.contacts.index') }}">{{ __('ui.admin.back') }}</a>
        </div>

        <div class="panel-body">
            <div class="message-meta">
                <div>
                    <span>{{ __('ui.admin.field_name') }}</span>
                    {{ $message->name }}
                </div>
                <div>
                    <span>{{ __('ui.admin.field_email') }}</span>
                    {{ $message->email }}
                </div>
                <div>
                    <span>{{ __('ui.admin.field_phone') }}</span>
                    {{ $message->phone ?: '—' }}
                </div>
            </div>

            <p>
                <strong>{{ __('ui.admin.field_subject') }}:</strong> {{ $message->subject ?: '—' }}
                &middot; {{ $message->created_at->translatedFormat('d M Y H:i') }}
            </p>

            <div class="message-body">{{ $message->message }}</div>

            <div class="form-actions mt-lg">
                <form method="POST" action="{{ route('admin.contacts.destroy', $message) }}"
                      data-confirm="{{ __('ui.admin.confirm_delete') }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">{{ __('ui.admin.delete') }}</button>
                </form>
                <a class="btn btn-outline" href="{{ route('admin.contacts.index') }}">{{ __('ui.admin.back') }}</a>
            </div>
        </div>
    </div>
@endsection
