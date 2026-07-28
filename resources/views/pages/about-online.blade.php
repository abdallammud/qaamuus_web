@extends('layouts.dict')
@section('title', __('ui.about_online.page_title') . ' — ' . __('ui.brand.name'))

@php $navKey = 'about-online'; @endphp

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10">

    <header class="mb-8 pb-6 border-b border-cream-deep">
        <h1 class="font-serif text-3xl font-bold text-ink">{{ __('ui.about_online.heading') }}</h1>
        <p class="text-ink-600/80 mt-2">{{ __('ui.about_online.subheading') }}</p>
    </header>

    <div class="space-y-8 text-ink-700 leading-relaxed">

        <section>
            <h2 class="font-serif text-xl font-semibold text-ink mb-2">{{ __('ui.about_online.what_heading') }}</h2>
            <p>
                {!! __('ui.about_online.what_body', ['words' => number_format(\App\Models\Entry::count())]) !!}
            </p>
        </section>

        <section>
            <h2 class="font-serif text-xl font-semibold text-ink mb-2">{{ __('ui.about_online.who_heading') }}</h2>
            <p class="mb-3">{{ __('ui.about_online.who_intro') }}</p>
            <ul class="space-y-1.5 list-disc list-inside marker:text-brand-400">
                <li>{!! __('ui.about_online.who_puglielli') !!}</li>
                <li>{!! __('ui.about_online.who_mansuur') !!}</li>
                <li>{!! __('ui.about_online.who_committee') !!}</li>
                <li>{!! __('ui.about_online.who_editors') !!}</li>
            </ul>
            <p class="mt-3 text-sm text-ink-600/80">
                {!! __('ui.about_online.who_note') !!}
            </p>
        </section>

        <section>
            <h2 class="font-serif text-xl font-semibold text-ink mb-2">{{ __('ui.about_online.built_heading') }}</h2>
            <p class="mb-3">{{ __('ui.about_online.built_intro') }}</p>
            <ol class="space-y-2 list-decimal list-inside marker:text-brand-400 marker:font-semibold">
                <li>{!! __('ui.about_online.built_extraction') !!}</li>
                <li>{!! __('ui.about_online.built_parsing') !!}</li>
                <li>{!! __('ui.about_online.built_structuring', [
                    'entries' => number_format(\App\Models\Entry::count()),
                    'definitions' => number_format(\App\Models\Definition::count()),
                ]) !!}</li>
                <li>{!! __('ui.about_online.built_presentation') !!}</li>
            </ol>
        </section>

        <section>
            <h2 class="font-serif text-xl font-semibold text-ink mb-2">{{ __('ui.about_online.community_heading') }}</h2>
            <p>
                {!! __('ui.about_online.community_body') !!}
            </p>
        </section>

        <section>
            <h2 class="font-serif text-xl font-semibold text-ink mb-2">{!! __('ui.about_online.credits_heading') !!}</h2>
            <p class="text-sm text-ink-600/80">
                {{ __('ui.about_online.credits_body') }}
            </p>
        </section>

    </div>
</div>
@endsection
