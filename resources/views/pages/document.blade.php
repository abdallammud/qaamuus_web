@extends('layouts.dict')
@section('title', $pageTitle . ' — ' . __('ui.brand.name'))

@section('content')
<div
    x-data="{
        current: '',
        init() {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(e => { if (e.isIntersecting) this.current = e.target.id; });
            }, { rootMargin: '-20% 0px -70% 0px' });
            this.$el.querySelectorAll('[data-section]').forEach(s => obs.observe(s));
        }
    }"
    class="lg:flex lg:gap-8 max-w-6xl mx-auto px-4 sm:px-6 py-8"
>
    {{-- ========== Secondary sidebar: subtitles ========== --}}
    <nav class="lg:w-64 shrink-0 mb-6 lg:mb-0">
        <div class="lg:sticky lg:top-20">
            <p class="text-xs font-semibold uppercase tracking-wider text-ink-600/55 mb-3">{{ $subtitle }}</p>
            <ul class="space-y-0.5 max-h-[70vh] overflow-y-auto pr-2">
                @foreach ($doc['sections'] as $s)
                    <li>
                        <a href="#{{ $s['id'] }}"
                           :class="current === '{{ $s['id'] }}' ? 'bg-brand-50 text-brand-800 font-medium' : 'text-ink-600/80 hover:text-brand-700'"
                           @class([
                               'block rounded-md px-3 py-1.5 text-sm transition',
                               'pl-6 text-[13px]' => ($s['level'] ?? 2) >= 3,
                           ])>
                            @if (!empty($s['num']))<span class="text-brand-400 mr-1">{{ $s['num'] }}</span>@endif
                            {{ $s['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    {{-- ========== Document body ========== --}}
    <article class="min-w-0 flex-1">
        <header class="mb-8 pb-6 border-b border-cream-deep">
            <h1 class="font-serif text-3xl font-bold text-ink">{{ $doc['title'] ?: $pageTitle }}</h1>
            <p class="text-ink-600/55 text-sm mt-1">{{ $subtitle }}</p>
        </header>

        <div class="space-y-10">
            @foreach ($doc['sections'] as $s)
                <section id="{{ $s['id'] }}" data-section class="scroll-mt-24">
                    @php $lvl = $s['level'] ?? 2; @endphp
                    @if ($lvl >= 3)
                        <h3 class="font-serif text-xl font-semibold text-ink mb-3">
                            @if (!empty($s['num']))<span class="text-brand-500">{{ $s['num'] }}</span> @endif{{ $s['title'] }}
                        </h3>
                    @else
                        <h2 class="font-serif text-2xl font-bold text-ink mb-3">
                            @if (!empty($s['num']))<span class="text-brand-500">{{ $s['num'] }}.</span> @endif{{ $s['title'] }}
                        </h2>
                    @endif
                    @if (($s['type'] ?? '') === 'abbreviations')
                        <div class="overflow-x-auto rounded-2xl border border-cream-deep bg-white">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-cream-deep text-left">
                                        @foreach ($s['columns'] as $col)
                                            <th class="px-4 py-2.5 text-[11px] font-semibold uppercase tracking-wide text-ink-600/60">{{ $col }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($s['rows'] as $row)
                                        <tr class="border-b border-cream-soft last:border-0 hover:bg-cream-soft/60">
                                            <td class="px-4 py-2 font-serif italic font-semibold text-ink whitespace-nowrap">{{ $row[0] }}</td>
                                            <td class="px-4 py-2 text-ink-700">{{ $row[1] }}</td>
                                            <td class="px-4 py-2 text-ink-600/80 italic">{{ $row[2] }}</td>
                                            <td class="px-4 py-2 text-ink-700">{{ $row[3] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="prose-doc text-ink-700 leading-relaxed space-y-3">
                            {!! $s['html'] !!}
                        </div>
                    @endif
                </section>
            @endforeach
        </div>

        @if (empty($doc['sections']))
            <p class="text-ink-600/55 italic">{{ __('ui.pages.unavailable') }}</p>
        @endif
    </article>
</div>
@endsection
