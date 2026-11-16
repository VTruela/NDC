<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteText;
use App\Support\ImageUpload;
use App\Support\SiteTexts;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Kustomisasi seluruh teks website & upload logo/gambar halaman. Hanya dapat diakses admin.
 */
class SiteTextController extends Controller
{
    public function index(Request $request): View
    {
        $locale = $this->locale($request);
        $sections = SiteTexts::sections($locale);
        $section = $request->query('section');

        if (! is_string($section) || ! array_key_exists($section, $sections)) {
            $section = array_key_first($sections);
        }

        return view('admin.texts.index', [
            'locale' => $locale,
            'section' => $section,
            'sections' => $sections,
            'entries' => SiteTexts::entries($locale, $section),
            'defaultsCount' => count(SiteTexts::entries($locale, $section)),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => ['required', 'in:id,en'],
            'section' => ['required', 'string'],
            'texts' => ['nullable', 'array'],
            'texts.*' => ['nullable', 'string'],
            'logo_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'hero_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'about_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        $locale = $data['locale'];
        $section = $data['section'];
        $defaults = SiteTexts::defaultsFor($section, $locale);

        foreach ($request->input('texts', []) as $name => $value) {
            $key = str_replace(':', '.', (string) $name);

            if (! array_key_exists($key, $defaults)) {
                continue;
            }

            $localeColumn = str_starts_with($key, SiteTexts::UI) ? $locale : '';
            $value = (string) ($value ?? '');

            if (trim($value) === trim((string) $defaults[$key])) {
                SiteText::query()->where('key', $key)->where('locale', $localeColumn)->delete();

                continue;
            }

            SiteText::query()->updateOrCreate(
                ['key' => $key, 'locale' => $localeColumn],
                ['value' => $value],
            );
        }

        // Handle branding image uploads (logo kiri atas, hero image, about image)
        $imageMappings = [
            'logo_file' => ['key' => 'company.logo', 'remove' => 'remove_logo'],
            'hero_image_file' => ['key' => 'company.hero_image', 'remove' => 'remove_hero_image'],
            'about_image_file' => ['key' => 'company.about_image', 'remove' => 'remove_about_image'],
        ];

        foreach ($imageMappings as $fileInput => $meta) {
            $currentPath = SiteTexts::value($meta['key'], '');

            if ($request->boolean($meta['remove'])) {
                ImageUpload::delete($currentPath);
                SiteText::query()->where('key', $meta['key'])->where('locale', '')->delete();
            }

            if ($request->hasFile($fileInput)) {
                $stored = ImageUpload::store($request->file($fileInput), 'branding', $currentPath);
                SiteText::query()->updateOrCreate(
                    ['key' => $meta['key'], 'locale' => ''],
                    ['value' => (string) $stored],
                );
            }
        }

        SiteTexts::flush();

        return redirect()
            ->route('admin.texts.index', ['locale' => $locale, 'section' => $section])
            ->with('success', __('ui.admin.texts_saved'));
    }

    public function reset(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => ['required', 'in:id,en'],
            'section' => ['required', 'string'],
        ]);

        if ($data['section'] === SiteTexts::COMPANY_SECTION) {
            SiteText::query()->where('key', 'like', SiteTexts::COMPANY . '%')->delete();
        } else {
            SiteText::query()
                ->where('key', 'like', SiteTexts::UI . '%')
                ->where('locale', $data['locale'])
                ->delete();
        }

        SiteTexts::flush();

        return redirect()
            ->route('admin.texts.index', ['locale' => $data['locale'], 'section' => $data['section']])
            ->with('success', __('ui.admin.texts_reset_done'));
    }

    private function locale(Request $request): string
    {
        $locale = $request->query('locale');

        return is_string($locale) && in_array($locale, SiteTexts::LOCALES, true)
            ? $locale
            : app()->getLocale();
    }
}
