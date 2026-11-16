<?php

namespace App\Support;

use Illuminate\Support\Str;

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

        return self::placeholder($seed ?: 'product', $size);
    }

    public static function placeholder(string $prompt = '', string $size = 'landscape_4_3'): string
    {
        $lower = strtolower($prompt);

        if (str_contains($lower, 'logo')) {
            return asset('assets/images/placeholder-logo.svg');
        }
        if ($size === 'square' || str_contains($lower, 'portrait') || str_contains($lower, 'avatar') || str_contains($lower, 'professional')) {
            return asset('assets/images/placeholder-avatar.svg');
        }
        if (str_contains($lower, 'article') || str_contains($lower, 'editorial') || str_contains($lower, 'blog')) {
            return asset('assets/images/placeholder-article.svg');
        }
        if (str_contains($lower, 'category') || str_contains($lower, 'industry') || str_contains($lower, 'plant') || str_contains($lower, 'laboratory')) {
            return asset('assets/images/placeholder-category.svg');
        }

        return asset('assets/images/placeholder-product.svg');
    }

    public static function logoUrl(): string
    {
        $custom = config('company.logo');

        if ($custom && file_exists(public_path($custom))) {
            return asset($custom);
        }

        return asset('assets/images/placeholder-logo.svg');
    }

    public static function heroUrl(): string
    {
        $custom = config('company.hero_image');

        if ($custom && file_exists(public_path($custom))) {
            return asset($custom);
        }

        return asset('assets/images/placeholder-category.svg');
    }

    public static function aboutUrl(): string
    {
        $custom = config('company.about_image');

        if ($custom && file_exists(public_path($custom))) {
            return asset($custom);
        }

        return asset('assets/images/placeholder-category.svg');
    }
}
