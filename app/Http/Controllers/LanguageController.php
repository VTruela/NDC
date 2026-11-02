<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public const LOCALES = ['id', 'en'];

    public function switch(string $locale): RedirectResponse
    {
        abort_unless(in_array($locale, self::LOCALES, true), 404);

        session(['locale' => $locale]);
        app()->setLocale($locale);

        return redirect()->back();
    }
}
