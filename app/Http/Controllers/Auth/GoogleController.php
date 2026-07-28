<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /** Redirect the user to Google's OAuth consent screen. */
    public function redirect()
    {
        if (! config('services.google.client_id')) {
            return redirect()->route('login')
                ->withErrors(['google' => __('ui.flash.google_unconfigured')]);
        }

        return Socialite::driver('google')->redirect();
    }

    /** Handle the callback from Google. */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Throwable $e) {
            return redirect()->route('login')
                ->withErrors(['google' => __('ui.flash.google_failed')]);
        }

        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if ($user) {
            $user->forceFill([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ])->save();
        } else {
            $user = User::create([
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'User',
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(Str::random(32)),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('home'));
    }
}
