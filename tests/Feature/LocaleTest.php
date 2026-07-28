<?php

namespace Tests\Feature;

use App\Support\Locale;
use Tests\TestCase;

class LocaleTest extends TestCase
{
    public function test_the_interface_defaults_to_english(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee(trans('ui.auth.remember_me', [], 'en'))
            ->assertSee(trans('ui.auth.log_in', [], 'en'));
    }

    public function test_the_toggle_switches_the_interface_to_somali(): void
    {
        $this->get('/lang/so')->assertRedirect();

        $this->assertSame('so', session(Locale::SESSION_KEY));

        $this->get('/login')
            ->assertOk()
            ->assertSee(trans('ui.auth.remember_me', [], 'so'))
            ->assertDontSee(trans('ui.auth.remember_me', [], 'en'));
    }

    public function test_the_toggle_switches_back_to_english(): void
    {
        $this->withSession([Locale::SESSION_KEY => 'so'])->get('/lang/en')->assertRedirect();

        $this->assertSame('en', session(Locale::SESSION_KEY));
    }

    public function test_the_toggle_returns_to_the_previous_page(): void
    {
        $this->get('/lang/so', ['Referer' => url('/login')])
            ->assertRedirect(url('/login'));
    }

    public function test_an_unsupported_language_is_rejected(): void
    {
        $this->get('/lang/fr')->assertNotFound();

        $this->assertNull(session(Locale::SESSION_KEY));
    }

    public function test_validation_messages_are_translated(): void
    {
        $this->withSession([Locale::SESSION_KEY => 'so'])
            ->post('/login', ['email' => '', 'password' => ''])
            ->assertSessionHasErrors([
                'email' => trans('validation.required', ['attribute' => trans('validation.attributes.email', [], 'so')], 'so'),
            ]);
    }

    public function test_every_interface_string_exists_in_both_languages(): void
    {
        $flatten = function (array $lines, string $prefix = '') use (&$flatten): array {
            $keys = [];
            foreach ($lines as $key => $value) {
                $path = $prefix === '' ? (string) $key : $prefix . '.' . $key;
                $keys = array_merge($keys, is_array($value) ? $flatten($value, $path) : [$path]);
            }

            return $keys;
        };

        $english = $flatten(require lang_path('en/ui.php'));
        $somali = $flatten(require lang_path('so/ui.php'));

        $this->assertSame([], array_diff($english, $somali), 'Missing Somali translations.');
        $this->assertSame([], array_diff($somali, $english), 'Somali strings with no English counterpart.');
    }
}
