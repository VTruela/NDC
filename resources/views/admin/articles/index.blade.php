@extends('layouts.admin')

@section('title', __('ui.admin.articles'))
@section('heading', __('ui.admin.articles'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.articles') }}</h2>
            @if (auth()->user()->canManageContent())
                <a class="btn btn-primary btn-sm" href="{{ route('admin.articles.create') }}">+ {{ __('ui.admin.new_article') }}</a>
            @endif
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>{{ __('ui.admin.articles') }}</th>
                        <th>{{ __('ui.admin.field_author') }}</th>
                        <th>{{ __('ui.admin.field_published_at') }}</th>
                        <th>{{ __('ui.admin.status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td>
                                <div class="cell-media">
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy">
                                    <div>
                                        <strong>{{ $article->title }}</strong>
                                        <small>{{ \Illuminate\Support\Str::limit($article->excerpt, 60) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $article->author ?: '—' }}</td>
                            <td>{{ $article->published_at?->translatedFormat('d M Y') }}</td>
                            <td>
                                <span class="badge {{ $article->is_published ? 'badge-success' : 'badge-warning' }}">
                                    {{ $article->is_published ? __('ui.admin.badge_published') : __('ui.admin.badge_draft') }}
                                </span>
                            </td>
                            <td class="row-actions">
                                @if (auth()->user()->canManageContent())
                                    <a class="btn btn-outline btn-sm" href="{{ route('admin.articles.edit', $article) }}">
                                        {{ __('ui.admin.edit') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}"
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
        {{ $articles->links() }}
    </div>
@endsection
