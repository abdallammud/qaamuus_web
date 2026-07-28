@extends('layouts.dict')
@section('title', __('ui.history.title') . ' — ' . __('ui.brand.name'))

@php $navKey = 'history'; @endphp

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">
    <div class="flex items-center justify-between mb-5">
        <h1 class="font-serif text-2xl font-bold text-ink">{{ __('ui.history.title') }}</h1>
        @if ($history->total() > 0)
            <form method="POST" action="{{ route('history.clear') }}"
                  onsubmit="return confirm(@js(__('ui.history.confirm_clear')))">
                @csrf @method('DELETE')
                <button class="text-sm text-ink-600/55 hover:text-red-600">{{ __('ui.history.clear_all') }}</button>
            </form>
        @endif
    </div>

    @forelse ($history as $item)
        @if ($item->entry)
            <a href="{{ route('word.show', $item->entry) }}"
               class="flex items-center justify-between gap-3 bg-white rounded-xl border border-cream-deep px-5 py-3.5 mb-2 hover:border-brand-300 transition">
                <div class="flex items-baseline gap-2 min-w-0">
                    <span class="font-medium text-ink truncate">{{ $item->entry->displayHeadword() }}</span>
                    <span class="text-xs text-ink-600/55 uppercase shrink-0">{{ $item->entry->posLabel() }}</span>
                </div>
                <span class="text-xs text-ink-600/55 shrink-0">{{ $item->viewed_at?->diffForHumans() }}</span>
            </a>
        @endif
    @empty
        <div class="text-center py-16 text-ink-600/55">
            <p class="text-lg">{{ __('ui.history.empty') }}</p>
            <p class="text-sm mt-1">{{ __('ui.history.empty_hint') }}</p>
        </div>
    @endforelse

    <div class="mt-6">{{ $history->links() }}</div>
</div>
@endsection
