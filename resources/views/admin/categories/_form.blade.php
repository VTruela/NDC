@php($category = $category ?? null)

<div class="panel">
    <div class="panel-head">
        <h2>{{ $category ? __('ui.admin.edit_category') : __('ui.admin.new_category') }}</h2>
        <a class="btn btn-outline btn-sm" href="{{ route('admin.categories.index') }}">{{ __('ui.admin.back') }}</a>
    </div>

    <div class="panel-body">
        <form class="form-grid" method="POST" enctype="multipart/form-data" action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}">
            @csrf
            @if ($category)
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="field">
                    <label for="name">{{ __('ui.admin.field_name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                           data-slug-source="#slug" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="slug">{{ __('ui.admin.field_slug') }}</label>
                    <input id="slug" type="text" value="{{ $category->slug ?? '' }}" readonly>
                    <span class="hint">{{ __('ui.admin.field_slug') }} dibuat otomatis dari nama.</span>
                </div>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="lang_id">{{ __('ui.admin.field_lang_id') }}</label>
                    <input id="lang_id" type="text" name="lang_id" value="{{ old('lang_id', $category->lang_id ?? '') }}">
                    @error('lang_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="lang_en">{{ __('ui.admin.field_lang_en') }}</label>
                    <input id="lang_en" type="text" name="lang_en" value="{{ old('lang_en', $category->lang_en ?? '') }}">
                    @error('lang_en')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="theme">{{ __('ui.admin.field_theme') }}</label>
                    <select id="theme" name="theme" required>
                        @foreach ($themes as $theme)
                            <option value="{{ $theme }}"
                                @selected((string) old('theme', $category->theme ?? 'institutional') === $theme)>
                                {{ $theme }}
                            </option>
                        @endforeach
                    </select>
                    @error('theme')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="image">{{ __('ui.admin.image') }}</label>
                    @if ($category && $category->image)
                        <img class="image-preview" src="{{ $category->image_url }}" alt="{{ $category->name }}">
                    @endif
                    <input id="image" type="file" name="image" accept="image/*">
                    <span class="hint">{{ __('ui.admin.image_hint') }}</span>
                    @error('image')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="field">
                <label for="description">{{ __('ui.admin.field_description') }}</label>
                <textarea id="description" name="description">{{ old('description', $category->description ?? '') }}</textarea>
                @error('description')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">{{ __('ui.admin.save') }}</button>
                <a class="btn btn-outline" href="{{ route('admin.categories.index') }}">{{ __('ui.admin.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
