@extends('layouts.admin')

@section('title', __('ui.admin.categories'))
@section('heading', __('ui.admin.categories'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.categories') }}</h2>
            @if (auth()->user()->isAdmin())
                <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.create') }}">+ {{ __('ui.admin.new_category') }}</a>
            @endif
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.field_category') }}</th>
                        <th>{{ __('ui.admin.field_lang_id') }} / {{ __('ui.admin.field_lang_en') }}</th>
                        <th>{{ __('ui.admin.field_theme') }}</th>
                        <th>{{ __('ui.admin.products') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                <div class="cell-media">
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy">
                                    <div>
                                        <strong>{{ $category->name }}</strong>
                                        <small>{{ $category->slug }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $category->lang_id ?: '—' }}<br>
                                <small>{{ $category->lang_en ?: '—' }}</small>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $category->theme }}</span>
                            </td>
                            <td>{{ $category->products_count }}</td>
                            <td class="row-actions">
                                @if (auth()->user()->isAdmin())
                                    <a class="btn btn-outline btn-sm" href="{{ route('admin.categories.edit', $category) }}">
                                        {{ __('ui.admin.edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
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
                            <td colspan="5" class="empty-state">{{ __('ui.admin.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrap">
        {{ $categories->links() }}
    </div>
@endsection
