@extends('layouts.admin')

@section('title', __('ui.admin.contacts'))
@section('heading', __('ui.admin.contacts'))
@section('crumb', __('ui.admin.menu_management'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.contacts') }}</h2>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.field_name') }}</th>
                        <th>{{ __('ui.admin.field_subject') }}</th>
                        <th></th>
                        <th>{{ __('ui.admin.status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                        <tr class="message-row {{ $message->is_read ? '' : 'is-unread' }}">
                            <td>
                                <strong>{{ $message->name }}</strong><br>
                                <small>{{ $message->email }}</small>
                            </td>
                            <td>{{ $message->subject ?: '—' }}</td>
                            <td>{{ $message->created_at->translatedFormat('d M Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $message->is_read ? 'badge-success' : 'badge-warning' }}">
                                    {{ $message->is_read ? __('ui.admin.read') : __('ui.admin.unread') }}
                                </span>
                            </td>
                            <td class="row-actions">
                                <a class="btn btn-outline btn-sm" href="{{ route('admin.contacts.show', $message) }}">
                                    {{ __('ui.admin.message_detail') }}
                                </a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $message) }}"
                                      data-confirm="{{ __('ui.admin.confirm_delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">{{ __('ui.admin.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">{{ __('ui.admin.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $messages->links() }}
    </div>
@endsection
