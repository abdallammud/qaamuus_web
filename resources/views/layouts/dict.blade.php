<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebar: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('ui.brand.full'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700|source-serif-4:400,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cream text-ink">
@php
    $favCount = auth()->check() ? auth()->user()->favorites()->count() : 0;
    $histCount = auth()->check() ? auth()->user()->histories()->count() : 0;
    $nav = $navKey ?? '';
@endphp
<div class="min-h-screen lg:flex">

    {{-- ===================== Primary sidebar ===================== --}}
    <aside
        class="fixed inset-y-0 left-0 z-40 w-72 bg-white border-r border-cream-deep flex flex-col transition-transform duration-200 lg:translate-x-0 lg:sticky lg:top-0 lg:h-screen"
        :class="sidebar ? 'translate-x-0' : '-translate-x-full'"
    >
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-6 py-6">
            <span class="grid place-items-center w-11 h-11 rounded-xl bg-brand-500 text-white font-bold text-xl font-serif shadow-sm">Q</span>
            <span>
                <span class="block font-serif text-lg font-bold leading-none text-ink">{{ __('ui.brand.name') }}</span>
                <span class="block text-xs text-ink-600 mt-1">{{ __('ui.brand.tagline') }}</span>
            </span>
        </a>

        <nav class="flex-1 px-3 py-2 space-y-1">
            <x-nav-item :active="$nav==='home'" :href="route('home')" :label="__('ui.nav.home')">
                <path d="M3 9.5 12 3l9 6.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V9.5Z"/>
            </x-nav-item>
            <x-nav-item :active="$nav==='about'" :href="route('about')" :label="__('ui.nav.about')">
                <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"/><path d="M12 16v-5"/><path d="M12 8h.01"/>
            </x-nav-item>
            <x-nav-item :active="$nav==='grammar'" :href="route('grammar')" :label="__('ui.nav.grammar')">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2Z"/>
            </x-nav-item>
            <x-nav-item :active="$nav==='about-online'" :href="route('about-online')" :label="__('ui.nav.about_online')">
                <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"/><path d="M2 12h20"/><path d="M12 2a15 15 0 0 1 0 20 15 15 0 0 1 0-20Z"/>
            </x-nav-item>

            <div class="px-3 pt-4 pb-1 text-[11px] font-semibold uppercase tracking-wider text-ink-600/60">{{ __('ui.nav.account_section') }}</div>

            <x-nav-item :active="$nav==='favorites'" :href="route('favorites.index')" :label="__('ui.nav.bookmarks')" :badge="$favCount ?: null">
                <path d="m12 17-5.9 3.1 1.1-6.6L2.5 8.9l6.6-1L12 2l2.9 5.9 6.6 1-4.7 4.6 1.1 6.6z"/>
            </x-nav-item>
            <x-nav-item :active="$nav==='history'" :href="route('history.index')" :label="__('ui.nav.history')" :badge="$histCount ?: null">
                <path d="M3 3v5h5"/><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/><path d="M12 7v5l4 2"/>
            </x-nav-item>
            <x-nav-item :active="$nav==='account'" :href="auth()->check() ? route('profile.edit') : route('login')" :label="__('ui.nav.settings')">
                <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2Z"/><circle cx="12" cy="12" r="3"/>
            </x-nav-item>
        </nav>

        {{-- Pro tip --}}
        <div class="mx-4 mb-3 rounded-xl bg-accent-50 border border-accent-200/70 px-4 py-3">
            <p class="text-xs font-bold text-accent-700">{{ __('ui.tip.title') }}</p>
            <p class="text-xs text-ink-600 mt-1 leading-relaxed">
                {{ __('ui.tip.body') }}
            </p>
        </div>

        <div class="px-5 py-4 border-t border-cream-deep text-xs">
            @auth
                <div class="flex items-center gap-2 text-ink-600">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" class="w-7 h-7 rounded-full" alt="">
                    @else
                        <span class="grid place-items-center w-7 h-7 rounded-full bg-brand-100 text-brand-700 font-semibold">
                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                        </span>
                    @endif
                    <span class="truncate">{{ auth()->user()->name }}</span>
                </div>
            @else
                <a href="{{ route('login') }}" class="font-medium text-brand-600 hover:text-brand-700">{{ __('ui.common.sign_in_arrow') }}</a>
            @endauth
        </div>
    </aside>

    {{-- mobile overlay --}}
    <div x-show="sidebar" x-cloak @click="sidebar=false" class="fixed inset-0 z-30 bg-black/30 lg:hidden"></div>

    {{-- ===================== Main column ===================== --}}
    <div class="flex-1 min-w-0 flex flex-col">
        {{-- Topbar --}}
        <header class="sticky top-0 z-20 bg-cream/90 backdrop-blur border-b border-cream-deep">
            <div class="flex items-center gap-3 px-4 sm:px-8 h-16">
                <button @click="sidebar=true" class="lg:hidden p-2 -ml-2 text-ink-600" aria-label="{{ __('ui.nav.open_menu') }}">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h16M3 11h16M3 16h16"/></svg>
                </button>

                @include('partials.searchbar')

                <div class="ml-auto flex items-center gap-2">
                    {{-- Interface language: Somali / English --}}
                    <x-language-switcher />

                    <div class="hidden sm:flex items-center gap-2">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="text-sm text-ink-600 hover:text-brand-700">{{ __('ui.common.log_out') }}</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-brand-600 hover:text-brand-700">{{ __('ui.common.sign_in') }}</a>
                            <a href="{{ route('register') }}" class="text-sm font-medium px-3.5 py-1.5 rounded-lg bg-ink text-white hover:bg-ink-700">{{ __('ui.common.register') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        @if (session('status'))
            <div class="mx-4 sm:mx-8 mt-4 rounded-lg bg-brand-50 text-brand-800 border border-brand-100 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <main class="flex-1">
            @yield('content')
        </main>

        <footer class="border-t border-cream-deep px-8 py-5 text-xs text-ink-600/70 text-center">
            {{ __('ui.footer.credit') }} ·
            <a href="{{ route('about-online') }}" class="underline hover:text-brand-600">{{ __('ui.common.learn_more') }}</a>
        </footer>
    </div>
</div>
</body>
</html>
