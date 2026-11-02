@extends('layouts.admin')

@section('title', __('ui.admin.dashboard'))
@section('heading', __('ui.admin.dashboard'))
@section('crumb', __('ui.admin.welcome') . ', ' . auth()->user()->name)

@section('content')
    <div class="stat-grid">
        <div class="stat-card">
            <span>{{ __('ui.admin.total_products') }}</span>
            <strong>{{ $stats['products'] }}</strong>
        </div>
        <div class="stat-card">
            <span>{{ __('ui.admin.total_categories') }}</span>
            <strong>{{ $stats['categories'] }}</strong>
        </div>
        <div class="stat-card">
            <span>{{ __('ui.admin.total_articles') }}</span>
            <strong>{{ $stats['articles'] }}</strong>
        </div>
        <div class="stat-card">
            <span>{{ __('ui.admin.total_testimonials') }}</span>
            <strong>{{ $stats['testimonials'] }}</strong>
        </div>
        <div class="stat-card {{ $stats['unread'] > 0 ? 'is-alert' : '' }}">
            <span>{{ __('ui.admin.unread_messages') }}</span>
            <strong>{{ $stats['unread'] }}</strong>
        </div>
    </div>

    <div class="panel mb-md">
        <div class="panel-head">
            <h2>{{ __('ui.admin.latest_messages') }}</h2>
            <a class="btn btn-outline btn-sm" href="{{ route('admin.contacts.index') }}">{{ __('ui.admin.view_all') }}</a>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.field_name') }}</th>
                        <th>{{ __('ui.admin.field_subject') }}</th>
                        <th>{{ __('ui.admin.status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestMessages as $message)
                        <tr>
                            <td>
                                <strong>{{ $message->name }}</strong><br>
                                <small>{{ $message->email }}</small>
                            </td>
                            <td>{{ $message->subject ?: '—' }}</td>
                            <td>
                                <span class="badge {{ $message->is_read ? 'badge-success' : 'badge-warning' }}">
                                    {{ $message->is_read ? __('ui.admin.read') : __('ui.admin.unread') }}
                                </span>
                            </td>
                            <td class="row-actions">
                                <a class="btn btn-outline btn-sm" href="{{ route('admin.contacts.show', $message) }}">
                                    {{ __('ui.admin.message_detail') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">{{ __('ui.admin.empty') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.latest_products') }}</h2>
            <a class="btn btn-outline btn-sm" href="{{ route('admin.products.index') }}">{{ __('ui.admin.view_all') }}</a>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.products') }}</th>
                        <th>{{ __('ui.admin.field_category') }}</th>
                        <th>{{ __('ui.admin.status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestProducts as $product)
                        <tr>
                            <td>
                                <div class="cell-media">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
                                    <div><strong>{{ $product->name }}</strong></div>
                                </div>
                            </td>
                            <td>{{ $product->category->localized_name }}</td>
                            <td>
                                <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-danger' }}">
                                    {{ $product->is_active ? __('ui.admin.field_active') : __('ui.admin.status') . ': —' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="empty-state">{{ __('ui.admin.empty') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
