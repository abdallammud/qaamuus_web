{{-- Live search box with autocomplete (Alpine). --}}
<div
    x-data="{
        q: '',
        open: false,
        results: [],
        active: -1,
        timer: null,
        search() {
            clearTimeout(this.timer);
            if (this.q.trim().length < 1) { this.results = []; this.open = false; return; }
            this.timer = setTimeout(async () => {
                const res = await fetch('{{ route('dictionary.autocomplete') }}?q=' + encodeURIComponent(this.q));
                this.results = await res.json();
                this.open = this.results.length > 0;
                this.active = -1;
            }, 160);
        },
        go(url) { window.location = url; },
        submit() {
            if (this.active >= 0 && this.results[this.active]) { this.go(this.results[this.active].url); }
            else { window.location = '{{ route('home') }}?q=' + encodeURIComponent(this.q); }
        }
    }"
    @keydown.escape="open=false"
    @click.outside="open=false"
    class="relative flex-1 min-w-0 max-w-2xl"
>
    <div class="relative">
        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-600/50" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="8" cy="8" r="6"/><path d="m17 17-4-4"/>
        </svg>
        <input
            x-model="q"
            @input="search()"
            @keydown.arrow-down.prevent="active = Math.min(active+1, results.length-1)"
            @keydown.arrow-up.prevent="active = Math.max(active-1, 0)"
            @keydown.enter.prevent="submit()"
            type="search"
            autocomplete="off"
            placeholder="{{ __('ui.common.search_placeholder') }}"
            aria-label="{{ __('ui.common.search_placeholder') }}"
            class="w-full rounded-2xl border-cream-deep bg-white pl-11 pr-4 py-2.5 text-sm text-ink placeholder:text-ink-600/50 focus:border-brand-400 focus:ring-brand-400 shadow-sm"
        >
    </div>

    <div x-show="open" x-cloak
         class="absolute z-30 mt-2 w-full bg-white rounded-2xl shadow-xl border border-cream-deep overflow-hidden">
        <template x-for="(r, i) in results" :key="r.id">
            <a :href="r.url"
               :class="i === active ? 'bg-brand-50' : ''"
               class="flex items-center justify-between gap-3 px-4 py-2.5 hover:bg-brand-50 border-b border-cream-soft last:border-0">
                <span class="font-serif font-semibold text-ink" x-text="r.headword"></span>
                <span class="text-[11px] text-ink-600/60 uppercase tracking-wide" x-text="r.pos"></span>
            </a>
        </template>
    </div>
</div>
