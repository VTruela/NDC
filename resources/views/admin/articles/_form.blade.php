@php($article = $article ?? null)

<div class="panel">
    <div class="panel-head">
        <h2>{{ $article ? __('ui.admin.edit_article') : __('ui.admin.new_article') }}</h2>
        <a class="btn btn-outline btn-sm" href="{{ route('admin.articles.index') }}">{{ __('ui.admin.back') }}</a>
    </div>

    <div class="panel-body">
        <form class="form-grid" method="POST" enctype="multipart/form-data" action="{{ $article ? route('admin.articles.update', $article) : route('admin.articles.store') }}">
            @csrf
            @if ($article)
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="field">
                    <label for="title">{{ __('ui.admin.field_title') }}</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $article->title ?? '') }}"
                           data-slug-source="#slug" required>
                    @error('title')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="slug">{{ __('ui.admin.field_slug') }}</label>
                    <input id="slug" type="text" value="{{ $article->slug ?? '' }}" readonly>
                    <span class="hint">{{ __('ui.admin.field_slug') }} dibuat otomatis dari nama.</span>
                </div>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="author">{{ __('ui.admin.field_author') }}</label>
                    <input id="author" type="text" name="author" value="{{ old('author', $article->author ?? '') }}">
                    @error('author')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="published_at">{{ __('ui.admin.field_published_at') }}</label>
                    <input id="published_at" type="datetime-local" name="published_at"
                           value="{{ old('published_at', optional($article->published_at ?? null)->format('Y-m-d\TH:i')) }}">
                    @error('published_at')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="field">
                <label for="image">{{ __('ui.admin.image') }}</label>
                @if ($article && $article->image)
                    <img class="image-preview" src="{{ $article->image_url }}" alt="{{ $article->title }}">
                @endif
                <input id="image" type="file" name="image" accept="image/*">
                <span class="hint">{{ __('ui.admin.image_hint') }}</span>
                @error('image')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label for="excerpt">{{ __('ui.admin.field_excerpt') }}</label>
                <textarea id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                @error('excerpt')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label for="content">{{ __('ui.admin.field_content') }}</label>
                <textarea id="content" name="content" rows="10">{{ old('content', $article->content ?? '') }}</textarea>
                @error('content')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-row">
                <label class="checkbox">
                    <input type="checkbox" name="is_published" value="1"
                        @checked(old('is_published', $article->is_published ?? true))>
                    <span>{{ __('ui.admin.field_published') }}</span>
                </label>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">{{ __('ui.admin.save') }}</button>
                <a class="btn btn-outline" href="{{ route('admin.articles.index') }}">{{ __('ui.admin.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
