@extends('layouts.dict')
@section('title', __('ui.domains.page_title') . ' — ' . __('ui.brand.name'))

@php $navKey = 'home'; @endphp

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-8 py-8">

    <div class="mb-6">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm text-ink-600/70 hover:text-brand-700 mb-4">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4 8 8l4 4M8 8h8"/></svg>
            {{ __('ui.domains.back_home') }}
        </a>
        <h1 class="font-serif text-3xl font-bold text-ink">{{ __('ui.domains.heading') }}</h1>
        <p class="text-ink-600/80 mt-1">{{ __('ui.domains.subheading', ['count' => count($domains)]) }}</p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($domains as $code => $count)
            <a href="{{ route('home', ['domain' => $code]) }}"
               class="group rounded-2xl bg-ink hover:bg-ink-700 p-6 transition shadow-sm">
                <h2 class="font-serif text-2xl font-bold text-white">{{ \App\Models\Entry::domainName($code) }}</h2>
                <p class="mt-4 text-sm text-white/55">{{ trans_choice('ui.domains.word_count', $count, ['count' => number_format($count)]) }}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
