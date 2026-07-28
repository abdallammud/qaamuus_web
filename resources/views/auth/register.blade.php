<x-guest-layout>
    {{-- Google sign-up is not configured yet — uncomment to re-enable (see README §6). --}}
    {{-- @include('partials.google-button') --}}

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('ui.auth.name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('ui.auth.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('ui.auth.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('ui.auth.confirm_password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-ink-600/80 hover:text-ink rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500" href="{{ route('login') }}">
                {{ __('ui.auth.already_registered') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('ui.common.register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
