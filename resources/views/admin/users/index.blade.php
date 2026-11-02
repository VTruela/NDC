@extends('layouts.admin')

@section('title', __('ui.admin.users'))
@section('heading', __('ui.admin.users'))
@section('crumb', __('ui.admin.menu_management'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.users') }}</h2>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.field_name') }}</th>
                        <th>{{ __('ui.admin.field_email') }}</th>
                        <th>{{ __('ui.admin.field_role') }}</th>
                        <th>{{ __('ui.admin.field_provider') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="cell-media">
                                    <span class="avatar">{{ strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        <small>{{ $user->created_at?->format('d M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge badge-info">{{ $user->roleLabel() }}</span>
                            </td>
                            <td>{{ $user->provider ?: '—' }}</td>
                            <td class="row-actions">
                                <a class="btn btn-outline btn-sm" href="{{ route('admin.users.edit', $user) }}">
                                    {{ __('ui.admin.edit') }}
                                </a>
                                @unless ($user->is(auth()->user()))
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          data-confirm="{{ __('ui.admin.confirm_delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">{{ __('ui.admin.delete') }}</button>
                                    </form>
                                @endunless
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
        {{ $users->links() }}
    </div>
@endsection
