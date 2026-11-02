<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Menyimpan gambar unggahan ke public/uploads/<folder> dan mengembalikan path
 * relatifnya (mis. "uploads/products/ab12.jpg") agar dapat dipakai Media::url().
 */
class ImageUpload
{
    public static function store(?UploadedFile $file, string $folder, ?string $current = null): ?string
    {
        if (! $file) {
            return $current;
        }

        $directory = public_path('uploads/' . $folder);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        self::delete($current);

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $name = Str::random(24) . '.' . $extension;

        $file->move($directory, $name);

        return 'uploads/' . $folder . '/' . $name;
    }

    public static function delete(?string $path): void
    {
        if (! $path || Str::startsWith($path, ['http://', 'https://'])) {
            return;
        }

        $absolute = public_path($path);

        if (is_file($absolute)) {
            @unlink($absolute);
        }
    }
}
