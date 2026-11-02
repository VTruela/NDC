@php($testimonial = $testimonial ?? null)

<div class="panel">
    <div class="panel-head">
        <h2>{{ $testimonial ? __('ui.admin.edit_testimonial') : __('ui.admin.new_testimonial') }}</h2>
        <a class="btn btn-outline btn-sm" href="{{ route('admin.testimonials.index') }}">{{ __('ui.admin.back') }}</a>
    </div>

    <div class="panel-body">
        <form class="form-grid" method="POST" enctype="multipart/form-data" action="{{ $testimonial ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
            @csrf
            @if ($testimonial)
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="field">
                    <label for="name">{{ __('ui.admin.field_name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required>
                    @error('name')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="company">{{ __('ui.admin.field_company') }}</label>
                    <input id="company" type="text" name="company" value="{{ old('company', $testimonial->company ?? '') }}">
                    @error('company')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="field">
                    <label for="rating">{{ __('ui.admin.field_rating') }}</label>
                    <select id="rating" name="rating" required>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" @selected((int) old('rating', $testimonial->rating ?? 5) === $i)>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="field">
                    <label for="image">{{ __('ui.admin.image') }}</label>
                    @if ($testimonial && $testimonial->image)
                        <img class="image-preview" src="{{ $testimonial->image_url }}" alt="{{ $testimonial->name }}">
                    @endif
                    <input id="image" type="file" name="image" accept="image/*">
                    <span class="hint">{{ __('ui.admin.image_hint') }}</span>
                    @error('image')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="field">
                <label for="content">{{ __('ui.admin.field_content') }}</label>
                <textarea id="content" name="content" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
                @error('content')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-row">
                <label class="checkbox">
                    <input type="checkbox" name="is_active" value="1"
                        @checked(old('is_active', $testimonial->is_active ?? true))>
                    <span>{{ __('ui.admin.field_active') }}</span>
                </label>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">{{ __('ui.admin.save') }}</button>
                <a class="btn btn-outline" href="{{ route('admin.testimonials.index') }}">{{ __('ui.admin.cancel') }}</a>
            </div>
        </form>
    </div>
</div>
