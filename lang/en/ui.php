<?php

/*
|--------------------------------------------------------------------------
| Interface strings — English
|--------------------------------------------------------------------------
|
| Every visible label of the application shell lives here. The dictionary
| content itself (headwords, definitions, contributions) is *not* translated:
| it is data, and it stays exactly as the source dictionary recorded it.
|
| The Somali counterpart is lang/so/ui.php — keep both files in step.
|
*/

return [

    'brand' => [
        'name' => 'Qaamuus',
        'tagline' => 'Af-Soomaaliga',
        'full' => 'Qaamuuska Af-Soomaaliga',
        'subtitle' => 'Somali Dictionary',
    ],

    'language' => [
        'label' => 'Language',
        'switch_to' => 'Switch to :language',
        'en' => 'English',
        'so' => 'Somali',
        'en_short' => 'EN',
        'so_short' => 'SO',
    ],

    'nav' => [
        'home' => 'Home',
        'about' => 'About',
        'grammar' => 'Grammar',
        'about_online' => 'Online dictionary',
        'account_section' => 'Account',
        'bookmarks' => 'Bookmarks',
        'history' => 'History',
        'settings' => 'Settings',
        'open_menu' => 'Open menu',
    ],

    'common' => [
        'back' => 'Back',
        'sign_in' => 'Sign in',
        'sign_in_arrow' => 'Sign in →',
        'log_out' => 'Log out',
        'register' => 'Register',
        'search_placeholder' => 'Search words, phrases…',
        'learn_more' => 'Learn more',
        'view_all' => 'View all →',
        'all' => 'All',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'saved' => 'Saved.',
        'delete' => 'Delete',
        'submit' => 'Submit',
        'or' => 'or',
        'words' => 'words',
    ],

    'flash' => [
        'bookmark_added' => 'Added to bookmarks.',
        'bookmark_removed' => 'Removed from bookmarks.',
        'history_cleared' => 'History cleared.',
        'contribution_published' => 'Thank you! Your contribution has been published.',
        'contribution_deleted' => 'Contribution deleted.',
        'google_unconfigured' => 'Google sign-in is not configured yet. Add GOOGLE_CLIENT_ID / GOOGLE_CLIENT_SECRET to your .env file.',
        'google_failed' => 'Google sign-in failed. Please try again.',
    ],

    'tip' => [
        'title' => 'Pro tip',
        'body' => 'Sign in to bookmark words and add your own contributions to any entry.',
    ],

    'footer' => [
        'credit' => 'Qaamuuska Af-Soomaaliga · Prepared by Centro Studi Somali, Università Roma Tre',
    ],

    'home' => [
        'title' => 'Discover words',
        'browse_az' => 'Browse A–Z',
        'domains' => 'Domains',
        'results' => 'Results',
        'discover' => 'Discover',
        'count' => ':count words',
        'no_matches' => 'No matches for “:query”.',
        'no_matches_hint' => 'Check the spelling or try another word.',
        'word_of_day' => 'Word of the day',
        'read_full_entry' => 'Read full entry',
        'select_hint' => 'Select a word from the list to see its full entry.',
    ],

    'browse' => [
        'page_title' => 'Letter :letter',
        'heading' => 'Words starting with “:letter”',
    ],

    'domains' => [
        'page_title' => 'Domains',
        'back_home' => 'Back to home',
        'heading' => 'Browse by domain',
        'subheading' => ':count subject domains across the dictionary.',
        'word_count' => '{1} :count word|[2,*] :count words',
    ],

    'word' => [
        'homonym' => 'homonym :index',
        'bookmark' => 'Bookmark',
        'word_form' => 'Word form',
        'gender' => 'Gender',
        'plural' => 'Plural',
        'conjugation' => 'Conjugation',
        'explanation' => 'Explanation',
        'synonyms' => 'Synonyms',
        'other_forms' => 'Other forms',
        'no_definition' => 'No definition recorded.',
        'see' => 'See:',
        'not_applicable' => 'n/a',
        'unknown' => '—',
    ],

    'pos' => [
        'noun' => 'Noun',
        'verb' => 'Verb',
        'adjective' => 'Adjective',
        'pronoun' => 'Pronoun',
        'particle' => 'Particle',
        'adverb' => 'Adverb',
        'exclamation' => 'Exclamation',
        'preposition' => 'Preposition',
        'numeral' => 'Numeral',
    ],

    'gender' => [
        'm' => 'Masculine',
        'f' => 'Feminine',
        'b' => 'Masculine & feminine',
    ],

    'domain_labels' => [
        'daaw.' => 'Medicine',
        'fiis.' => 'Physics',
        'xis.' => 'Mathematics',
        'baay.' => 'Biology',
        'kiim.' => 'Chemistry',
        'dii.' => 'Religion',
        'juqr.' => 'Geography',
        'jool.' => 'Geology',
        'bot.' => 'Botany',
        'muus.' => 'Music',
        'siyaa.' => 'Politics',
        'taar.' => 'History',
        'dhaq.' => 'Commerce',
        'c.nafl' => 'Zoology',
        'qaan.' => 'Law',
        'c.naf' => 'Psychology',
    ],

    'contributions' => [
        'heading' => 'Community contributions',
        'empty' => 'No community contributions yet. Be the first to add one!',
        'add' => 'Add a contribution',
        'type' => 'Type',
        'dialect' => 'Dialect (optional)',
        'dialect_placeholder' => 'e.g. Maxaa-tiri, Maay…',
        'content' => 'Content',
        'content_placeholder' => 'Add an explanation, similar word, or example sentence…',
        'sign_in_prompt' => 'Sign in to contribute →',
        'types' => [
            'explanation' => 'More explanation',
            'synonym' => 'Similar word',
            'example_sentence' => 'Example sentence',
            'dialect_variant' => 'Dialect variant',
        ],
    ],

    'favorites' => [
        'title' => 'Bookmarks',
        'empty' => 'You have no bookmarks yet.',
        'empty_hint' => 'Tap the bookmark icon on any word to save it here.',
    ],

    'history' => [
        'title' => 'History',
        'clear_all' => 'Clear all',
        'confirm_clear' => 'Clear your entire history?',
        'empty' => 'No history yet.',
        'empty_hint' => 'Words you view will appear here.',
    ],

    'account' => [
        'title' => 'Account',
    ],

    'pages' => [
        'about_title' => 'About the dictionary',
        'grammar_title' => 'Somali grammar',
        'contents' => 'Contents',
        'unavailable' => 'Content not available.',
    ],

    'about_online' => [
        'page_title' => 'Online dictionary',
        'heading' => 'About the online dictionary',
        'subheading' => 'How it was prepared, and by whom.',

        'what_heading' => 'What is this?',
        'what_body' => 'This is a digital edition of the <strong>Qaamuuska Af-Soomaaliga</strong> (the Somali dictionary) published by <em>Centro Studi Somali, Università degli Studi Roma Tre</em> (ROMA TRE-PRESS, 2012, ISBN 978-88-97524-02-1). It lets you quickly search :words words — their meanings and grammatical information — from any browser.',

        'who_heading' => 'Who prepared it?',
        'who_intro' => 'The original dictionary was prepared by a team of researchers led by:',
        'who_puglielli' => '<strong>Annarita Puglielli</strong> — project director &amp; editor-in-chief (Università Roma Tre)',
        'who_mansuur' => '<strong>Cabdalla Cumar Mansuur</strong> — editor-in-chief',
        'who_committee' => '<strong>Research committee</strong> — Axmed Cabdullaahi Axmed, Ciise Maxamed Siyaad, Axmed Cartan Xaange, Maryan Faarax Warsame, Dahabo Faarax Xasan, Cabdi Daahir Afey, and others',
        'who_editors' => '<strong>Many editors</strong> — who collected, defined, and verified the entries',
        'who_note' => 'The project was part of the <em>Studi Somali</em> Italian–Somali research collaboration that began in 1977–78.',

        'built_heading' => 'How was this online edition built?',
        'built_intro' => 'The printed book was converted into structured data using a Natural Language Processing (NLP) pipeline:',
        'built_extraction' => '<strong>Extraction</strong> — the dictionary text was extracted from the source PDF.',
        'built_parsing' => '<strong>Parsing</strong> — each word was split into its headword, part of speech, gender, conjugation/plural, and individual senses.',
        'built_structuring' => '<strong>Structuring</strong> — the data was stored in a MySQL database — :entries entries and :definitions definitions.',
        'built_presentation' => '<strong>Presentation</strong> — this Laravel application serves the data in a simple, searchable interface.',

        'community_heading' => 'Community contributions',
        'community_body' => 'The dictionary is <strong>living</strong>. Registered users can add more explanation, similar words, example sentences, and words from different dialects. Community contributions are clearly marked and shown at the <span class="text-amber-600 font-medium">bottom of each word\'s page</span>, so they are kept separate from the original dictionary text.',

        'credits_heading' => 'Credits &amp; licence',
        'credits_body' => 'The lexical content belongs to the original authors (Centro Studi Somali, Roma Tre). This online edition is provided for educational and research purposes. Please cite the original source when using it.',
    ],

    'auth' => [
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'remember_me' => 'Remember me',
        'forgot_password' => 'Forgot your password?',
        'log_in' => 'Log in',
        'already_registered' => 'Already registered?',
        'continue_with_google' => 'Continue with Google',
        'reset_password' => 'Reset Password',
        'email_reset_link' => 'Email Password Reset Link',
        'forgot_intro' => 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
        'confirm' => 'Confirm',
        'confirm_intro' => 'This is a secure area of the application. Please confirm your password before continuing.',
        'verify_intro' => 'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.',
        'verify_sent' => 'A new verification link has been sent to the email address you provided during registration.',
        'resend_verification' => 'Resend Verification Email',
    ],

    'profile' => [
        'information' => 'Profile Information',
        'information_hint' => 'Update your account\'s profile information and email address.',
        'update_password' => 'Update Password',
        'update_password_hint' => 'Ensure your account is using a long, random password to stay secure.',
        'delete_account' => 'Delete Account',
        'delete_hint' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
        'delete_confirm_heading' => 'Are you sure you want to delete your account?',
        'delete_confirm_hint' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
        'email_unverified' => 'Your email address is unverified.',
        'resend_verification' => 'Click here to re-send the verification email.',
        'verification_sent' => 'A new verification link has been sent to your email address.',
    ],

];
