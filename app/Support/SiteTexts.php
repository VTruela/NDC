<?php

namespace App\Support;

use App\Models\SiteText;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * Sumber tunggal untuk seluruh teks yang tampil di website.
 *
 * Nilai default dibaca dari file:
 *  - lang/{locale}/ui.php  (seluruh label & kalimat antarmuka)
 *  - config/company.php    (profil perusahaan: nama, alamat, kontak, sosial)
 *
 * Administrator dapat mengganti nilainya lewat panel admin; penggantinya
 * disimpan pada tabel `site_texts` lalu disuntikkan saat request berjalan.
 */
class SiteTexts
{
    /** Prefix untuk baris terjemahan (per bahasa). */
    public const UI = 'ui.';

    /** Prefix untuk data profil perusahaan (berlaku semua bahasa). */
    public const COMPANY = 'company.';

    /** Bagian khusus untuk data profil perusahaan. */
    public const COMPANY_SECTION = 'company';

    public const LOCALES = ['id', 'en'];

    /**
     * Semua override: [key][locale] => value.
     *
     * @return array<string, array<string, string>>
     */
    public static function rows(): array
    {
        try {
            return Cache::rememberForever('site_texts:rows', function () {
                $map = [];

                foreach (SiteText::query()->get(['key', 'locale', 'value']) as $row) {
                    $map[$row->key][$row->locale] = (string) $row->value;
                }

                return $map;
            });
        } catch (\Throwable) {
            // Tabel belum dimigrasi / database belum siap: pakai nilai default.
            return [];
        }
    }

    public static function flush(): void
    {
        try {
            Cache::forget('site_texts:rows');
        } catch (\Throwable) {
            // abaikan
        }
    }

    public static function value(string $key, string $locale): ?string
    {
        return self::rows()[$key][$locale] ?? null;
    }

    /**
     * Terapkan seluruh override ke translator dan config untuk request berjalan.
     */
    public static function apply(string $locale): void
    {
        $rows = self::rows();

        if ($rows === []) {
            return;
        }

        $lines = [];
        $company = [];

        foreach ($rows as $key => $byLocale) {
            if (str_starts_with($key, self::UI)) {
                // addLines() memakai format "group.item"; kunci "ui.<group>.<item>"
                // dipakai apa adanya sehingga menjadi group "ui".
                if (isset($byLocale[$locale]) && substr_count($key, '.') === 2) {
                    $lines[$key] = $byLocale[$locale];
                }

                continue;
            }

            if (str_starts_with($key, self::COMPANY) && isset($byLocale[''])) {
                $company[Str::after($key, self::COMPANY)] = $byLocale[''];
            }
        }

        if ($lines !== []) {
            $translator = app('translator');

            // Muat file bahasa lebih dulu agar penimpaan tidak menghapus kunci lain.
            $translator->load('*', 'ui', $locale);

            $translator->addLines($lines, $locale);
        }

        if ($company !== []) {
            config(['company' => array_replace_recursive(config('company'), Arr::undot($company))]);
        }
    }

    /**
     * Daftar bagian yang bisa diedit: [slug => label].
     *
     * @return array<string, string>
     */
    public static function sections(string $locale): array
    {
        $sections = [];

        foreach (array_keys(self::uiDefaults($locale)) as $group) {
            $sections[$group] = Str::headline($group);
        }

        $sections[self::COMPANY_SECTION] = __('ui.admin.texts_company_section');

        return $sections;
    }

    /**
     * Daftar entri teks pada satu bagian, siap ditampilkan di form admin.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function entries(string $locale, string $section): array
    {
        $entries = [];

        foreach (self::defaultsFor($section, $locale) as $key => $default) {
            $localeColumn = str_starts_with($key, self::UI) ? $locale : '';
            $override = self::value($key, $localeColumn);
            $default = (string) $default;

            $entries[] = [
                'key' => $key,
                // Nama field memakai ":" karena PHP mengubah "." pada nama input menjadi "_".
                'name' => str_replace('.', ':', $key),
                'id' => 'text-' . str_replace(['.', '_'], '-', $key),
                'label' => Str::headline(Str::afterLast($key, '.')),
                'default' => $default,
                'value' => $override,
                'multiline' => str_contains($default, "\n") || mb_strlen($default) > 90,
                'modified' => $override !== null,
            ];
        }

        return $entries;
    }

    /**
     * Nilai default pada satu bagian: [key => default].
     *
     * @return array<string, mixed>
     */
    public static function defaultsFor(string $section, string $locale): array
    {
        if ($section === self::COMPANY_SECTION) {
            $defaults = [];

            foreach (Arr::dot(require config_path('company.php')) as $key => $value) {
                if (is_array($value)) {
                    continue;
                }

                $defaults[self::COMPANY . $key] = $value;
            }

            return $defaults;
        }

        $group = self::uiDefaults($locale)[$section] ?? [];

        $defaults = [];

        foreach ($group as $item => $value) {
            if (is_array($value) || ! is_scalar($value)) {
                continue;
            }

            $defaults[self::UI . $section . '.' . $item] = $value;
        }

        return $defaults;
    }

    /**
     * Isi file lang/{locale}/ui.php apa adanya (tanpa override).
     *
     * @return array<string, array<string, mixed>>
     */
    public static function uiDefaults(string $locale): array
    {
        $path = lang_path($locale . '/ui.php');

        return is_file($path) ? require $path : [];
    }
}
