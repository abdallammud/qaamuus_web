<?php

namespace App\Support;

/**
 * The two interface languages the application ships with.
 *
 * Dictionary content is never translated — this only covers the shell:
 * menus, labels, buttons, form fields and messages.
 */
class Locale
{
    public const SUPPORTED = [
        'en' => 'English',
        'so' => 'Soomaali',
    ];

    /** Session key holding the visitor's chosen interface language. */
    public const SESSION_KEY = 'locale';

    /** @return array<int, string> */
    public static function codes(): array
    {
        return array_keys(self::SUPPORTED);
    }

    public static function isSupported(?string $locale): bool
    {
        return $locale !== null && array_key_exists($locale, self::SUPPORTED);
    }

    /** The locale to fall back to when nothing has been chosen. */
    public static function default(): string
    {
        $configured = (string) config('app.locale');

        return self::isSupported($configured) ? $configured : 'en';
    }

    /** Native name of a locale, e.g. "Soomaali". */
    public static function nativeName(string $locale): string
    {
        return self::SUPPORTED[$locale] ?? $locale;
    }

    /** The *other* language — what the toggle switches to. */
    public static function alternate(?string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();

        return $locale === 'so' ? 'en' : 'so';
    }
}
