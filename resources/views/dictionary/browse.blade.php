@extends('layouts.dict')
@section('title', __('ui.browse.page_title', ['letter' => $letter]) . ' — ' . __('ui.brand.name'))

@php $navKey = 'home'; @endphp

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex flex-wrap gap-1.5 mb-6">
        @foreach ($letters as $l)
            <a href="{{ route('dictionary.browse', $l) }}"
               @class([
                   'w-9 h-9 grid place-items-center rounded-lg text-sm font-semibold transition',
                   'bg-brand-600 text-white' => $l === $letter,
                   'bg-white border border-cream-deep text-brand-700 hover:bg-brand-50' => $l !== $letter,
               ])>{{ $l }}</a>
        @endforeach
    </div>

    <h1 class="font-serif text-2xl font-bold text-ink mb-4">{{ __('ui.browse.heading', ['letter' => $letter]) }}</h1>

    <div class="grid sm:grid-cols-2 gap-2">
        @foreach ($entries as $entry)
            <a href="{{ route('word.show', $entry) }}"
               class="flex items-baseline justify-between gap-2 bg-white rounded-lg border border-cream-deep px-4 py-3 hover:border-brand-300 transition">
                <span class="font-medium text-ink">{{ $entry->displayHeadword() }}</span>
                <span class="text-xs text-ink-600/55 uppercase">{{ $entry->posLabel() }}</span>
            </a>
        @endforeach
    </div>

    <div class="mt-6">{{ $entries->links() }}</div>
</div>
@endsection
