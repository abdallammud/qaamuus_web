@props(['label' => '', 'value' => null])

@php
    $value ??= __('ui.word.unknown');
    // "does not apply" / "not recorded" are dimmed, in whichever language.
    $empty = in_array($value, [__('ui.word.not_applicable'), __('ui.word.unknown')], true);
@endphp

<div class="bg-white rounded-xl border border-cream-deep px-4 py-3.5">
    <dt class="text-[10px] font-semibold uppercase tracking-wide text-ink-600/55">{{ $label }}</dt>
    <dd @class([
        'mt-1 text-sm font-medium',
        'text-ink' => ! $empty,
        'text-ink-600/40' => $empty,
    ])>{{ $value }}</dd>
</div>
