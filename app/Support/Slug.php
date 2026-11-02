<?php

namespace App\Support;

use Illuminate\Support\Str;

class Slug
{
    /**
     * Membuat slug unik untuk sebuah model Eloquent.
     *
     * @param  class-string<\Illuminate\Database\Eloquent\Model>  $model
     */
    public static function unique(string $model, string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: Str::random(8);
        $slug = $base;
        $counter = 2;

        while ($model::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }
}
