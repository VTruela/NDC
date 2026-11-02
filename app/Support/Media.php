<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Helper untuk menyelesaikan path gambar: URL eksternal dipakai apa adanya,
 * file lokal di public/ dipetakan lewat asset(), dan jika belum ada gambar
 * maka dipakai gambar placeholder yang dibangkitkan secara dinamis.
 */
class Media
{
    public static function url(?string $path, ?string $seed = null, string $size = 'landscape_4_3'): string
    {
        if ($path) {
            if (Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }

            if (file_exists(public_path($path))) {
                return asset($path);
            }
        }

        return self::placeholder($seed ?: 'chemical industry', $size);
    }

    public static function placeholder(string $prompt, string $size = 'landscape_4_3'): string
    {
        return 'https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt='
            . urlencode($prompt)
            . '&image_size=' . $size;
    }
}
