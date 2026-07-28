{{-- Somali / English interface toggle. Dictionary content is never translated. --}}
@php
    $current = app()->getLocale();
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-1 rounded-xl border border-cream-deep bg-white p-1 shadow-sm']) }}
     role="group"
     aria-label="{{ __('ui.language.label') }}">
    @foreach (\App\Support\Locale::codes() as $code)
        @php $isCurrent = $code === $current; @endphp
        <a href="{{ route('locale.switch', $code) }}"
           hreflang="{{ $code }}"
           title="{{ $isCurrent
               ? \App\Support\Locale::nativeName($code)
               : __('ui.language.switch_to', ['language' => \App\Support\Locale::nativeName($code)]) }}"
           @if ($isCurrent) aria-current="true" @endif
           @class([
               'rounded-lg px-2.5 py-1 text-xs font-semibold uppercase tracking-wide leading-none transition',
               'bg-ink text-white' => $isCurrent,
               'text-ink-600 hover:bg-cream-soft hover:text-ink' => ! $isCurrent,
           ])>
            <span aria-hidden="true">{{ __('ui.language.' . $code . '_short') }}</span>
            <span class="sr-only">{{ \App\Support\Locale::nativeName($code) }}</span>
        </a>
    @endforeach
</div>
