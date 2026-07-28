<?php

namespace App\Http\Controllers;

use App\Support\DocContent;

class PageController extends Controller
{
    /** "About the dictionary" — content extracted from Intro.pdf. */
    public function about()
    {
        $doc = DocContent::load('about');

        return view('pages.document', [
            'pageTitle' => __('ui.pages.about_title'),
            'subtitle' => __('ui.pages.contents'),
            'doc' => $doc,
            'navKey' => 'about',
        ]);
    }

    /** "Naxwe / Grammar" — content extracted from naxwe.pdf. */
    public function grammar()
    {
        $doc = DocContent::load('grammar');

        return view('pages.document', [
            'pageTitle' => __('ui.pages.grammar_title'),
            'subtitle' => __('ui.pages.contents'),
            'doc' => $doc,
            'navKey' => 'grammar',
        ]);
    }

    /** "About the online dictionary" — authored project document. */
    public function aboutOnline()
    {
        return view('pages.about-online', [
            'navKey' => 'about-online',
        ]);
    }
}
