<?php

namespace App\Http\Middleware;

use App\Support\Locale;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Applies the interface language chosen with the header toggle.
 *
 * Order of preference: the session choice, then the browser's Accept-Language
 * header (first visit only), then the configured default.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get(Locale::SESSION_KEY);

        if (! Locale::isSupported($locale)) {
            $locale = $request->getPreferredLanguage(Locale::codes()) ?: Locale::default();
        }

        app()->setLocale($locale);
        Carbon::setLocale($locale);

        return $next($request);
    }
}
