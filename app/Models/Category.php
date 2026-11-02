<?php

namespace App\Models;

use App\Support\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'theme',
        'image',
        'lang_id',
        'lang_en',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getLocalizedNameAttribute(): string
    {
        $value = app()->getLocale() === 'en' ? $this->lang_en : $this->lang_id;

        return $value ?: $this->name;
    }

    public function getImageUrlAttribute(): string
    {
        return Media::url($this->image, $this->name . ' chemical industry, clean industrial photography');
    }

    public function themeClass(): string
    {
        return 'theme-' . ($this->theme ?: 'institutional');
    }
}
