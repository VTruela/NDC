<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LanguageController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', config('app.locale'));

        if (in_array($locale, LanguageController::LOCALES, true)) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
