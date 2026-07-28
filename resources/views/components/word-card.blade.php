@props(['entry'])

<a href="{{ route('word.show', $entry) }}"
   class="block bg-white rounded-2xl border border-cream-deep px-5 py-4 hover:border-brand-300 hover:shadow-sm transition">
    <div class="flex items-center gap-2.5 flex-wrap">
        <span class="font-serif text-xl font-bold text-ink">{{ $entry->headword }}</span>
        @if ($entry->homonym_index)
            <span class="text-xs text-ink-600/50">({{ $entry->homonym_index }})</span>
        @endif
        @if ($entry->domain)
            <span class="text-[10px] font-semibold uppercase tracking-wide px-2 py-0.5 rounded bg-cream-deep/60 text-ink-600">{{ $entry->domainLabel() }}</span>
        @endif
    </div>

    @if ($entry->pos_category)
        <p class="mt-0.5 font-serif italic text-sm text-ink-600/80">{{ $entry->posLabel() }}</p>
    @endif

    @if ($entry->definitions->isNotEmpty())
        <p class="mt-1.5 text-sm text-ink-600 leading-relaxed line-clamp-2">
            {{ $entry->definitions->first()->gloss }}
        </p>
    @endif
</a>
