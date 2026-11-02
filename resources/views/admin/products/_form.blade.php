@php($product = $product ?? null)

<div class="panel">
    <div class="panel-head">
        <h2>{{ $product ? __('ui.admin.edit_product') : __('ui.admin.new_product') }}</h2>
        <a class="btn btn-outline btn-sm" href="{{ route('admin.products.index') }}">{{ __('ui.admin.back') }}</a>
    </div>

    <div class="panel-body">
        <form class="form-grid" method="POST" enctype="multipart/form-data" action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}">
            @csrf
            @if ($product)
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="field">
                    <label for="name">{{ __('ui.admin.field_name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
                           data-slug-source="#slug" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="slug">{{ __('ui.admin.field_slug') }}</label>
                    <input id="slug" type="text" value="{{ $product->slug ?? '' }}" readonly>
                    <span class="hint">{{ __('ui.admin.field_slug') }} dibuat otomatis dari nama.</span>
                </div>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="category_id">{{ __('ui.admin.field_category') }}</label>
                    <select id="category_id" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected((int) old('category_id', $product->category_id ?? 0) === $category->id)>
                                {{ $category->localized_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="image">{{ __('ui.admin.image') }}</label>
                    @if ($product && $product->image)
                        <img class="image-preview" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    @endif
                    <input id="image" type="file" name="image" accept="image/*">
                    <span class="hint">{{ __('ui.admin.image_hint') }}</span>
                    @error('image')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="field">
                <label for="short_description">{{ __('ui.admin.field_short_description') }}</label>
                <input id="short_description" type="text" name="short_description"
                       value="{{ old('short_description', $product->short_description ?? '') }}">
                @error('short_description')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="field">
                <label for="description">{{ __('ui.admin.field_description') }}</label>
                <textarea id="description" name="description">{{ old('description', $product->description ?? '') }}</textarea>
                @error('description')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-row">
                <label class="checkbox">
                    <input type="checkbox" name="is_featured" value="1"
                        @checked(old('is_featured', $product->is_featured ?? false))>
                    <span>{{ __('ui.admin.field_featured') }}</span>
                </label>

                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1"
                        @checked(old('is_active', $product->is_active ?? true))>
                    <span>{{ __('ui.admin.field_active') }}</span>
                </label>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">{{ __('ui.admin.save') }}</button>
                <a class="btn btn-outline" href="{{ route('admin.products.index') }}">{{ __('ui.admin.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
