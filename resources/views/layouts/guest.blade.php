<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Qaamuuska') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|source-serif-4:400,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-ink antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 bg-cream px-4">
            <div class="w-full sm:max-w-md flex justify-end mb-4 sm:mb-2">
                <x-language-switcher />
            </div>

            <a href="{{ url('/') }}" class="flex items-center gap-3 mb-6">
                <span class="grid place-items-center w-12 h-12 rounded-xl bg-brand-500 text-white font-bold text-2xl font-serif shadow-sm">Q</span>
                <span class="text-left">
                    <span class="block font-serif text-xl font-bold leading-none text-ink">{{ __('ui.brand.name') }}</span>
                    <span class="block text-xs text-ink-600 mt-1">{{ __('ui.brand.tagline') }}</span>
                </span>
            </a>

            <div class="w-full sm:max-w-md px-6 py-7 sm:px-8 bg-white shadow-sm border border-cream-deep overflow-hidden rounded-2xl">
                {{ $slot }}
            </div>

            <p class="mt-6 text-xs text-ink-600/60 text-center">
                {{ __('ui.brand.full') }} · {{ __('ui.brand.subtitle') }}
            </p>
        </div>
    </body>
</html>
