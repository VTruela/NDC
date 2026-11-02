@extends('layouts.admin')

@section('title', __('ui.admin.testimonials'))
@section('heading', __('ui.admin.testimonials'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.testimonials') }}</h2>
            @if (auth()->user()->canManageContent())
                <a class="btn btn-primary btn-sm" href="{{ route('admin.testimonials.create') }}">+ {{ __('ui.admin.new_testimonial') }}</a>
            @endif
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.testimonials') }}</th>
                        <th>{{ __('ui.admin.field_rating') }}</th>
                        <th>{{ __('ui.admin.status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonials as $testimonial)
                        <tr>
                            <td>
                                <div class="cell-media">
                                    <img class="avatar" src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}" loading="lazy">
                                    <div>
                                        <strong>{{ $testimonial->name }}</strong>
                                        <small>{{ $testimonial->company ?: '—' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-warning">{{ str_repeat('★', $testimonial->rating) }} {{ $testimonial->rating }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $testimonial->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $testimonial->is_active ? __('ui.admin.badge_active') : __('ui.admin.badge_inactive') }}
                                </span>
                            </td>
                            <td class="row-actions">
                                @if (auth()->user()->canManageContent())
                                    <a class="btn btn-outline btn-sm" href="{{ route('admin.testimonials.edit', $testimonial) }}">
                                        {{ __('ui.admin.edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                          data-confirm="{{ __('ui.admin.confirm_delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">{{ __('ui.admin.delete') }}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="empty-state">{{ __('ui.admin.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $testimonials->links() }}
    </div>
@endsection
