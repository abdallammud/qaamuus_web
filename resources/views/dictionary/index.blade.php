@extends('layouts.dict')
@section('title', __('ui.brand.full'))

@php $navKey = 'home'; @endphp

@section('content')
<div class="px-4 sm:px-8 py-7 xl:grid xl:grid-cols-[minmax(0,1fr)_360px] xl:gap-10 max-w-7xl mx-auto">

    {{-- ===================== Discover column ===================== --}}
    <div class="min-w-0">
        <h1 class="font-serif text-3xl font-bold text-ink mb-5">{{ __('ui.home.title') }}</h1>

        {{-- Search --}}
        <form action="{{ route('home') }}" method="GET" class="relative mb-7">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-ink-600/50" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="8" cy="8" r="6"/><path d="m17 17-4-4"/>
            </svg>
            <input name="q" value="{{ $q }}" type="search" placeholder="{{ __('ui.common.search_placeholder') }}"
                   aria-label="{{ __('ui.common.search_placeholder') }}"
                   class="w-full rounded-2xl border-cream-deep bg-white pl-12 pr-4 py-3.5 text-sm text-ink placeholder:text-ink-600/50 focus:border-brand-400 focus:ring-brand-400 shadow-sm">
        </form>

        {{-- Browse A–Z --}}
        <div class="mb-6">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-ink-600/60 mb-3">{{ __('ui.home.browse_az') }}</p>
            <div class="flex flex-wrap gap-1.5">
                @foreach ($letters as $l)
                    <a href="{{ route('dictionary.browse', $l) }}"
                       class="w-9 h-9 grid place-items-center rounded-lg bg-white border border-cream-deep text-sm font-semibold text-ink hover:bg-brand-500 hover:text-white hover:border-brand-500 transition">{{ $l }}</a>
                @endforeach
            </div>
        </div>

        {{-- Domains --}}
        <div class="mb-7">
            <div class="flex items-center justify-between mb-3">
                <p class="text-[11px] font-semibold uppercase tracking-wider text-ink-600/60">{{ __('ui.home.domains') }}</p>
                <a href="{{ route('dictionary.domains') }}" class="text-xs font-medium text-brand-600 hover:text-brand-700">{{ __('ui.common.view_all') }}</a>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('home') }}"
                   @class([
                       'px-3.5 py-1.5 rounded-lg text-sm font-medium transition',
                       'bg-ink text-white' => $domain === '' && $q === '',
                       'bg-white border border-cream-deep text-ink-600 hover:border-brand-300' => ! ($domain === '' && $q === ''),
                   ])>{{ __('ui.common.all') }}</a>
                @foreach ($domains as $d)
                    <a href="{{ route('home', ['domain' => $d]) }}"
                       @class([
                           'px-3.5 py-1.5 rounded-lg text-sm font-medium transition',
                           'bg-ink text-white' => $domain === $d,
                           'bg-white border border-cream-deep text-ink-600 hover:border-brand-300' => $domain !== $d,
                       ])>{{ \App\Models\Entry::domainName($d) }}</a>
                @endforeach
            </div>
        </div>

        {{-- List header --}}
        <div class="flex items-baseline justify-between mb-3">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-ink-600/60">
                @if ($q !== '') {{ __('ui.home.results') }}
                @elseif ($domain !== '') {{ \App\Models\Entry::domainName($domain) }}
                @else {{ __('ui.home.discover') }} @endif
            </p>
            <p class="text-xs text-ink-600/60">
                {{ __('ui.home.count', ['count' => $q !== '' ? $results->count() : $discover->count()]) }}
            </p>
        </div>

        {{-- Word list --}}
        <div class="space-y-3">
            @if ($q !== '')
                @forelse ($results as $entry)
                    <x-word-card :entry="$entry" />
                @empty
                    <div class="text-center py-16 text-ink-600/60 bg-white rounded-2xl border border-cream-deep">
                        <p class="text-lg">{{ __('ui.home.no_matches', ['query' => $q]) }}</p>
                        <p class="text-sm mt-1">{{ __('ui.home.no_matches_hint') }}</p>
                    </div>
                @endforelse
            @else
                @foreach ($discover as $entry)
                    <x-word-card :entry="$entry" />
                @endforeach
            @endif
        </div>
    </div>

    {{-- ===================== Word of the day ===================== --}}
    <aside class="mt-10 xl:mt-0">
        <div class="xl:sticky xl:top-24">
            <p class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-wider text-accent-600 mb-3">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="m12 2 2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.8 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8L12 2Z"/></svg>
                {{ __('ui.home.word_of_day') }}
            </p>

            @if ($wordOfDay)
                <div class="rounded-3xl bg-gradient-to-br from-cream-card to-accent-100 border border-accent-200 p-6 shadow-sm">
                    <h2 class="font-serif text-4xl font-bold text-ink leading-tight">{{ $wordOfDay->headword }}</h2>
                    <div class="mt-2 flex items-center gap-2">
                        @if ($wordOfDay->pos_category)
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-white/70 text-ink-600 font-serif italic">{{ $wordOfDay->pos_category }}</span>
                        @endif
                        @if ($wordOfDay->domain)
                            <span class="text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded bg-white/60 text-ink-600">{{ $wordOfDay->domainLabel() }}</span>
                        @endif
                    </div>

                    @if ($wordOfDay->definitions->isNotEmpty())
                        <p class="mt-4 text-ink-700 leading-relaxed">{{ $wordOfDay->definitions->first()->gloss }}</p>
                    @endif

                    <a href="{{ route('word.show', $wordOfDay) }}"
                       class="mt-6 inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-ink text-white text-sm font-semibold hover:bg-ink-700 transition">
                        {{ __('ui.home.read_full_entry') }}
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 8h8M9 4l4 4-4 4"/></svg>
                    </a>
                </div>
                <p class="text-center text-sm text-ink-600/60 mt-5">{{ __('ui.home.select_hint') }}</p>
            @endif
        </div>
    </aside>
</div>
@endsection
