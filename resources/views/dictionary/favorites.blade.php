@extends('layouts.dict')
@section('title', __('ui.favorites.title') . ' — ' . __('ui.brand.name'))

@php $navKey = 'favorites'; @endphp

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">
    <h1 class="font-serif text-2xl font-bold text-ink mb-5">{{ __('ui.favorites.title') }}</h1>

    @forelse ($favorites as $fav)
        @if ($fav->entry)
            <a href="{{ route('word.show', $fav->entry) }}"
               class="block bg-white rounded-xl border border-cream-deep px-5 py-4 mb-3 hover:border-brand-300 transition">
                <div class="flex items-baseline gap-2">
                    <span class="font-serif text-lg font-semibold text-ink">{{ $fav->entry->displayHeadword() }}</span>
                    <span class="text-xs text-ink-600/55 uppercase">{{ $fav->entry->posLabel() }}</span>
                </div>
                @if ($fav->entry->definitions->isNotEmpty())
                    <p class="mt-1 text-sm text-ink-600 line-clamp-1">{{ $fav->entry->definitions->first()->gloss }}</p>
                @endif
            </a>
        @endif
    @empty
        <div class="text-center py-16 text-ink-600/55">
            <p class="text-lg">{{ __('ui.favorites.empty') }}</p>
            <p class="text-sm mt-1">{{ __('ui.favorites.empty_hint') }}</p>
        </div>
    @endforelse

    <div class="mt-6">{{ $favorites->links() }}</div>
</div>
@endsection
