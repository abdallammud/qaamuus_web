{{-- Community contributions: displayed at the footer of the word view and
     clearly marked as community-added content. --}}
<section class="mt-8">
    <div class="flex items-center gap-2 mb-3">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" class="text-amber-500">
            <path d="M16 18a4 4 0 0 0-8 0"/><circle cx="12" cy="7" r="3"/>
        </svg>
        <h2 class="text-sm font-semibold text-ink-700">{{ __('ui.contributions.heading') }}</h2>
    </div>

    @if ($entry->approvedContributions->isNotEmpty())
        <div class="space-y-3">
            @foreach ($entry->approvedContributions as $c)
                <div class="bg-amber-50/60 border border-amber-200 rounded-xl px-5 py-4">
                    <div class="flex items-center justify-between gap-3">
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            {{ $c->typeLabel() }}
                            @if ($c->dialect)
                                <span class="text-amber-600 font-normal">· {{ $c->dialect }}</span>
                            @endif
                        </span>
                        <span class="text-xs text-amber-600/70">
                            {{ $c->user->name }} · {{ $c->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="mt-2 text-ink-700 leading-relaxed">{{ $c->content }}</p>

                    @auth
                        @if ($c->user_id === auth()->id())
                            <form method="POST" action="{{ route('contributions.destroy', $c) }}" class="mt-2">
                                @csrf @method('DELETE')
                                <button class="text-xs text-amber-700/70 hover:text-red-600">{{ __('ui.common.delete') }}</button>
                            </form>
                        @endif
                    @endauth
                </div>
            @endforeach
        </div>
    @else
        <p class="text-sm text-ink-600/55 italic mb-4">
            {{ __('ui.contributions.empty') }}
        </p>
    @endif

    {{-- ===================== Add a contribution ===================== --}}
    @auth
        <div x-data="{ open: false }" class="mt-4">
            <button @click="open = !open"
                    class="inline-flex items-center gap-2 text-sm font-medium text-brand-700 hover:text-brand-800">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                {{ __('ui.contributions.add') }}
            </button>

            <form x-show="open" x-cloak method="POST" action="{{ route('contributions.store', $entry) }}"
                  class="mt-3 bg-white border border-cream-deep rounded-xl p-5 space-y-3">
                @csrf
                <div>
                    <label for="contribution-type" class="block text-xs font-semibold text-ink-600/80 mb-1">{{ __('ui.contributions.type') }}</label>
                    <select name="type" id="contribution-type" x-data="{ t: 'explanation' }" x-model="t"
                            class="w-full rounded-lg border-cream-deep text-sm focus:border-brand-400 focus:ring-brand-400">
                        @foreach (\App\Models\Contribution::typeOptions() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="contribution-dialect" class="block text-xs font-semibold text-ink-600/80 mb-1">{{ __('ui.contributions.dialect') }}</label>
                    <input name="dialect" id="contribution-dialect" type="text" placeholder="{{ __('ui.contributions.dialect_placeholder') }}"
                           class="w-full rounded-lg border-cream-deep text-sm focus:border-brand-400 focus:ring-brand-400">
                </div>

                <div>
                    <label for="contribution-content" class="block text-xs font-semibold text-ink-600/80 mb-1">{{ __('ui.contributions.content') }}</label>
                    <textarea name="content" id="contribution-content" rows="3" required
                              class="w-full rounded-lg border-cream-deep text-sm focus:border-brand-400 focus:ring-brand-400"
                              placeholder="{{ __('ui.contributions.content_placeholder') }}"></textarea>
                    @error('content') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <button class="px-4 py-2 rounded-lg bg-brand-600 text-white text-sm font-medium hover:bg-brand-700">
                    {{ __('ui.common.submit') }}
                </button>
            </form>
        </div>
    @else
        <a href="{{ route('login') }}" class="inline-block mt-4 text-sm text-brand-700 hover:underline">
            {{ __('ui.contributions.sign_in_prompt') }}
        </a>
    @endauth
</section>
