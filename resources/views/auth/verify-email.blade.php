<x-guest-layout>
    <div class="mb-4 text-sm text-ink-600/80">
        {{ __('ui.auth.verify_intro') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('ui.auth.verify_sent') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('ui.auth.resend_verification') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-ink-600/80 hover:text-ink rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                {{ __('ui.common.log_out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
