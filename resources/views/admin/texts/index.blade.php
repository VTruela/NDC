@extends('layouts.admin')

@section('title', __('ui.admin.texts'))
@section('heading', __('ui.admin.texts_heading'))
@section('crumb', __('ui.admin.menu_management'))

@section('content')
    <div class="panel">
        <div class="panel-head">
            <h2>{{ __('ui.admin.texts_heading') }}</h2>

            <form method="POST" action="{{ route('admin.texts.reset') }}"
                  data-confirm="{{ __('ui.admin.texts_reset_confirm') }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="locale" value="{{ $locale }}">
                <input type="hidden" name="section" value="{{ $section }}">
                <button class="btn btn-danger btn-sm" type="submit">{{ __('ui.admin.texts_reset') }}</button>
            </form>
        </div>

        <div class="panel-body">
            <p>{{ __('ui.admin.texts_lead') }}</p>

            @if ($section === \App\Support\SiteTexts::COMPANY_SECTION)
                <p>{{ __('ui.admin.texts_company_note') }}</p>
            @else
                <div class="texts-locales">
                    <span>{{ __('ui.admin.texts_locale') }}</span>
                    @foreach (\App\Support\SiteTexts::LOCALES as $code)
                        <a class="texts-tab {{ $code === $locale ? 'is-active' : '' }}"
                           href="{{ route('admin.texts.index', ['locale' => $code, 'section' => $section]) }}">
                            {{ strtoupper($code) }}
                        </a>
                    @endforeach
                </div>
            @endif

            <nav class="texts-sections">
                @foreach ($sections as $slug => $label)
                    <a class="texts-tab {{ $slug === $section ? 'is-active' : '' }}"
                       href="{{ route('admin.texts.index', ['locale' => $locale, 'section' => $slug]) }}">
                        {{ $label }}
                    </a>
                @endforeach
            </nav>

            <form class="form-grid" method="POST" action="{{ route('admin.texts.update') }}" id="textsForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="locale" value="{{ $locale }}">
                <input type="hidden" name="section" value="{{ $section }}">

                {{-- Upload Logo Kiri Atas & Gambar Halaman --}}
                @if (in_array($section, ['brand', \App\Support\SiteTexts::COMPANY_SECTION, 'home', 'about'], true))
                    <div class="panel" style="background:#f8fafc;border:1px solid #e2e8f0;padding:1.25rem;border-radius:12px;margin-bottom:1rem">
                        <h3 style="margin-bottom:.75rem;font-size:1rem">Logo Kiri Atas &amp; Gambar Halaman Utama</h3>
                        <div class="form-row">
                            <div class="field">
                                <label for="logo_file">Logo Website (Kiri Atas Header &amp; Footer)</label>
                                <div style="margin-bottom:.5rem">
                                    <img src="{{ \App\Support\Media::logoUrl() }}" alt="Logo Preview" style="width:64px;height:64px;border-radius:12px;object-fit:contain;border:1px solid #cbd5e1;background:#fff;padding:4px">
                                </div>
                                <input id="logo_file" type="file" name="logo_file" accept="image/*">
                                <span class="hint">Unggah logo perusahaan (PNG/SVG/JPG/WebP). Kosongkan untuk tetap memakai logo placeholder.</span>
                                @if (config('company.logo'))
                                    <label style="display:inline-flex;align-items:center;gap:.4rem;margin-top:.4rem;font-size:.82rem;color:#dc2626">
                                        <input type="checkbox" name="remove_logo" value="1"> Hapus logo kustom (kembali ke placeholder)
                                    </label>
                                @endif
                            </div>

                            <div class="field">
                                <label for="hero_image_file">Gambar Banner Beranda (Hero)</label>
                                <div style="margin-bottom:.5rem">
                                    <img src="{{ \App\Support\Media::heroUrl() }}" alt="Hero Preview" style="width:110px;height:64px;border-radius:8px;object-fit:cover;border:1px solid #cbd5e1">
                                </div>
                                <input id="hero_image_file" type="file" name="hero_image_file" accept="image/*">
                                <span class="hint">Gambar utama di halaman Beranda.</span>
                                @if (config('company.hero_image'))
                                    <label style="display:inline-flex;align-items:center;gap:.4rem;margin-top:.4rem;font-size:.82rem;color:#dc2626">
                                        <input type="checkbox" name="remove_hero_image" value="1"> Kembali ke placeholder
                                    </label>
                                @endif
                            </div>

                            <div class="field">
                                <label for="about_image_file">Gambar Halaman Tentang Kami</label>
                                <div style="margin-bottom:.5rem">
                                    <img src="{{ \App\Support\Media::aboutUrl() }}" alt="About Preview" style="width:110px;height:64px;border-radius:8px;object-fit:cover;border:1px solid #cbd5e1">
                                </div>
                                <input id="about_image_file" type="file" name="about_image_file" accept="image/*">
                                <span class="hint">Gambar pada bagian Cerita Kami.</span>
                                @if (config('company.about_image'))
                                    <label style="display:inline-flex;align-items:center;gap:.4rem;margin-top:.4rem;font-size:.82rem;color:#dc2626">
                                        <input type="checkbox" name="remove_about_image" value="1"> Kembali ke placeholder
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="field">
                    <label for="textsSearch">{{ __('ui.admin.texts_search') }}</label>
                    <input id="textsSearch" type="search" autocomplete="off"
                           placeholder="{{ __('ui.admin.texts_search_placeholder') }}">
                </div>

                @if (empty($entries))
                    <p class="empty-state">{{ __('ui.admin.texts_empty') }}</p>
                @else
                    <div class="texts-list" id="textsList">
                        @foreach ($entries as $entry)
                            <div class="field texts-item"
                                 data-search="{{ mb_strtolower($entry['label'] . ' ' . $entry['key'] . ' ' . ($entry['value'] ?? $entry['default'])) }}">
                                <label for="{{ $entry['id'] }}">
                                    {{ $entry['label'] }}
                                    @if ($entry['modified'])
                                        <span class="badge badge-warning">{{ __('ui.admin.texts_modified') }}</span>
                                    @endif
                                    <small class="texts-key">{{ $entry['key'] }}</small>
                                </label>

                                @if ($entry['multiline'])
                                    <textarea id="{{ $entry['id'] }}" name="texts[{{ $entry['name'] }}]"
                                              rows="4">{{ $entry['value'] ?? $entry['default'] }}</textarea>
                                @else
                                    <input id="{{ $entry['id'] }}" type="text"
                                           name="texts[{{ $entry['name'] }}]"
                                           value="{{ $entry['value'] ?? $entry['default'] }}">
                                @endif

                                @if ($entry['modified'])
                                    <span class="hint">{{ __('ui.admin.texts_default') }}:
                                        {{ \Illuminate\Support\Str::limit($entry['default'], 160) }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <p class="hint" id="textsNoResult" hidden>{{ __('ui.admin.texts_no_result') }}</p>
                @endif

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">{{ __('ui.admin.texts_save') }}</button>
                    <span class="texts-count">{{ __('ui.admin.texts_count', ['count' => $defaultsCount]) }}</span>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function () {
            var search = document.getElementById('textsSearch');
            var list = document.getElementById('textsList');
            var empty = document.getElementById('textsNoResult');

            if (!search || !list) {
                return;
            }

            var items = Array.prototype.slice.call(list.querySelectorAll('.texts-item'));

            search.addEventListener('input', function () {
                var term = search.value.trim().toLowerCase();
                var shown = 0;

                items.forEach(function (item) {
                    var match = term === '' || item.dataset.search.indexOf(term) !== -1;

                    item.hidden = !match;
                    shown += match ? 1 : 0;
                });

                if (empty) {
                    empty.hidden = shown !== 0;
                }
            });
        })();
    </script>
@endsection
