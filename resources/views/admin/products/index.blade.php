@extends('layouts.admin')

@section('title', __('ui.admin.products'))
@section('heading', __('ui.admin.products'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.products') }}</h2>
            @if (auth()->user()->isAdmin())
                <a class="btn btn-primary btn-sm" href="{{ route('admin.products.create') }}">+ {{ __('ui.admin.new_product') }}</a>
            @endif
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.products') }}</th>
                        <th>{{ __('ui.admin.field_category') }}</th>
                        <th>{{ __('ui.admin.status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <div class="cell-media">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <small>{{ \Illuminate\Support\Str::limit($product->short_description, 60) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->category->localized_name }}</td>
                            <td>
                                <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $product->is_active ? __('ui.admin.badge_active') : __('ui.admin.badge_inactive') }}
                                </span>
                                @if ($product->is_featured)
                                    <span class="badge badge-info">{{ __('ui.admin.badge_featured') }}</span>
                                @endif
                            </td>
                            <td class="row-actions">
                                @if (auth()->user()->isAdmin())
                                    <a class="btn btn-outline btn-sm" href="{{ route('admin.products.edit', $product) }}">
                                        {{ __('ui.admin.edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
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
        {{ $products->links() }}
    </div>
@endsection
