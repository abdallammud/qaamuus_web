@extends('layouts.dict')
@section('title', $entry->headword . ' — ' . __('ui.brand.name'))

@php $navKey = 'home'; @endphp

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-8 py-8">

    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-1.5 text-sm text-ink-600/70 hover:text-brand-700 mb-5">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4 8 8l4 4M8 8h8"/></svg>
        {{ __('ui.common.back') }}
    </a>

    {{-- ===================== Headword hero ===================== --}}
    <div class="rounded-3xl bg-gradient-to-br from-cream-card to-accent-100 border border-accent-200 p-7 sm:p-8 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="font-serif text-5xl font-bold text-ink leading-none">{{ $entry->headword }}</h1>
                <div class="mt-3 flex flex-wrap items-center gap-2">
                    @if ($entry->homonym_index)
                        <span class="text-xs px-2 py-0.5 rounded-full bg-white/70 text-ink-600">{{ __('ui.word.homonym', ['index' => $entry->homonym_index]) }}</span>
                    @endif
                    <span class="font-serif italic text-ink-700">{{ $entry->posLabel() }}</span>
                    @if ($entry->domain)
                        <span class="text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded bg-white/60 text-ink-600">{{ $entry->domainLabel() }}</span>
                    @endif
                </div>
            </div>

            @auth
                <form method="POST" action="{{ route('favorites.toggle', $entry) }}">
                    @csrf
                    <button type="submit" title="{{ __('ui.word.bookmark') }}"
                            class="grid place-items-center w-11 h-11 rounded-full bg-white/70 hover:bg-white text-accent-600 transition shadow-sm">
                        <svg width="22" height="22" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                             fill="{{ $isFavorite ? 'currentColor' : 'none' }}">
                            <path d="M6 3h12a1 1 0 0 1 1 1v17l-7-4-7 4V4a1 1 0 0 1 1-1Z"/>
                        </svg>
                    </button>
                </form>
            @endauth
        </div>
    </div>

    {{-- ===================== Grammar meta grid ===================== --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-5">
        <x-meta :label="__('ui.word.word_form')" :value="$entry->posLabel()" />
        <x-meta :label="__('ui.word.gender')" :value="$entry->genderLabel()" />
        <x-meta :label="__('ui.word.plural')" :value="$entry->pluralLabel()" />
        <x-meta :label="__('ui.word.conjugation')" :value="$entry->conjugationLabel()" />
    </div>

    {{-- ===================== Definitions ===================== --}}
    <div class="bg-white rounded-2xl border border-cream-deep p-6 sm:p-7 mt-5">
        <h2 class="text-[11px] font-semibold uppercase tracking-wider text-ink-600/60 mb-4">{{ __('ui.word.explanation') }}</h2>

        @if ($entry->definitions->isNotEmpty())
            <ol class="space-y-4">
                @foreach ($entry->definitions as $def)
                    <li class="flex gap-3.5">
                        <span class="shrink-0 w-6 h-6 grid place-items-center rounded-full bg-brand-50 text-brand-600 text-xs font-bold">
                            {{ $def->sense_number }}
                        </span>
                        <p class="text-ink-700 leading-relaxed">
                            @if ($def->gloss_prefix)
                                <span class="font-semibold text-ink">{{ $def->gloss_prefix }}:</span>
                            @endif
                            {{ $def->gloss }}
                            @if ($def->domain)
                                <span class="ml-1 text-xs text-accent-600">[{{ \App\Models\Entry::domainName($def->domain) }}]</span>
                            @endif
                        </p>
                    </li>
                @endforeach
            </ol>
        @elseif ($redirectTarget)
            <p class="text-ink-700">
                {{ __('ui.word.see') }}
                <a href="{{ route('word.show', $redirectTarget) }}" class="text-brand-700 font-semibold hover:underline">
                    {{ $redirectTarget->headword }}
                </a>
            </p>
        @else
            <p class="text-ink-600/50 italic">{{ __('ui.word.no_definition') }}</p>
        @endif

        {{-- Synonyms --}}
        @if ($entry->synonyms->isNotEmpty())
            <div class="mt-6 pt-5 border-t border-cream-soft">
                <h2 class="text-[11px] font-semibold uppercase tracking-wider text-ink-600/60 mb-2.5">{{ __('ui.word.synonyms') }}</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($entry->synonyms as $syn)
                        @php $target = $relatedEntries[$syn->target_entry_id] ?? null; @endphp
                        @if ($target)
                            <a href="{{ route('word.show', $target) }}"
                               class="px-3 py-1 rounded-full bg-brand-50 text-brand-700 text-sm hover:bg-brand-100">{{ $syn->target_headword }}</a>
                        @else
                            <span class="px-3 py-1 rounded-full bg-cream-soft text-ink-600 text-sm">{{ $syn->target_headword }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- ===================== Other forms of the word ===================== --}}
    @if ($otherForms->isNotEmpty())
        <section class="mt-7">
            <h2 class="text-sm font-semibold text-ink mb-3">{{ __('ui.word.other_forms') }}</h2>
            <div class="space-y-3">
                @foreach ($otherForms as $form)
                    <a href="{{ route('word.show', $form) }}"
                       class="block bg-white rounded-2xl border border-cream-deep px-5 py-4 hover:border-brand-300 transition">
                        <div class="flex items-baseline gap-2 flex-wrap">
                            <span class="font-serif text-lg font-bold text-ink">{{ $form->displayHeadword() }}</span>
                            <span class="font-serif italic text-sm text-ink-600/70">{{ $form->posLabel() }}</span>
                        </div>
                        @if ($form->definitions->isNotEmpty())
                            <p class="mt-1 text-sm text-ink-600">{{ $form->definitions->first()->gloss }}</p>
                        @else
                            <p class="mt-1 text-sm text-ink-600/50 italic">{{ __('ui.word.no_definition') }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ===================== Community contributions (footer) ===================== --}}
    @include('dictionary.partials.contributions')

</div>
@endsection
