@extends('layouts.dict')
@section('title', __('ui.account.title') . ' — ' . __('ui.brand.name'))

@php $navKey = 'account'; @endphp

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 space-y-6">
    <h1 class="font-serif text-2xl font-bold text-ink">{{ __('ui.account.title') }}</h1>

    <div class="p-6 bg-white shadow-sm border border-cream-deep rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-6 bg-white shadow-sm border border-cream-deep rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-6 bg-white shadow-sm border border-cream-deep rounded-xl">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
