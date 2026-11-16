<?php

namespace App\Http\Middleware;

use App\Support\SiteTexts;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Menyuntikkan teks kustom yang diatur admin (tabel site_texts)
 * ke translator dan config sebelum halaman dirender.
 */
class LoadSiteTexts
{
    public function handle(Request $request, Closure $next): Response
    {
        SiteTexts::apply(app()->getLocale());

        return $next($request);
    }
}
