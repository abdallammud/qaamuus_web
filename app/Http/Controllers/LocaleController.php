<?php

namespace App\Http\Controllers;

use App\Support\Locale;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /** Switch the interface language and return to the page the user was on. */
    public function switch(Request $request, string $locale)
    {
        abort_unless(Locale::isSupported($locale), 404);

        $request->session()->put(Locale::SESSION_KEY, $locale);

        return back();
    }
}
