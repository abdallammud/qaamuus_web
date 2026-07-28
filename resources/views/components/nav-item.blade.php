@props(['href' => '#', 'label' => '', 'active' => false, 'badge' => null])

<a href="{{ $href }}"
   @class([
       'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition',
       'bg-brand-50 text-brand-700' => $active,
       'text-ink-600 hover:bg-cream-soft hover:text-ink' => ! $active,
   ])>
    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor"
         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
         @class(['shrink-0', 'text-brand-500' => $active, 'text-ink-600/70' => ! $active])>
        {{ $slot }}
    </svg>
    <span class="truncate flex-1">{{ $label }}</span>
    @if (! is_null($badge))
        <span @class([
            'shrink-0 text-[11px] font-semibold px-2 py-0.5 rounded-full',
            'bg-brand-500 text-white' => $active,
            'bg-cream-deep text-ink-600' => ! $active,
        ])>{{ $badge }}</span>
    @endif
</a>
