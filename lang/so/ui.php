<?php

/*
|--------------------------------------------------------------------------
| Erayada muuqaalka — Af-Soomaali
|--------------------------------------------------------------------------
|
| Halkan waxaa ku jira dhammaan qoraallada muuqda ee barnaamijka.
| Nuxurka qaamuuska laftiisa (erayada, micnayaasha, wax ku darsiga) lama turjumo:
| waa xog, waxaana loo reebaa sidii uu qaamuuska asalka ahi u qoray.
|
| Faylka Ingiriisiga waa lang/en/ui.php — labadaba si isku mid ah u cusboonaysii.
|
*/

return [

    'brand' => [
        'name' => 'Qaamuus',
        'tagline' => 'Af-Soomaaliga',
        'full' => 'Qaamuuska Af-Soomaaliga',
        'subtitle' => 'Qaamuus onlayn ah',
    ],

    'language' => [
        'label' => 'Afka',
        'switch_to' => 'U beddel :language',
        'en' => 'Ingiriis',
        'so' => 'Soomaali',
        'en_short' => 'EN',
        'so_short' => 'SO',
    ],

    'nav' => [
        'home' => 'Bogga hore',
        'about' => 'Ku saabsan',
        'grammar' => 'Naxwaha',
        'about_online' => 'Qaamuuska onlaynka ah',
        'account_section' => 'Akoonka',
        'bookmarks' => 'Waxyaabaha la kaydiyay',
        'history' => 'Taariikhda',
        'settings' => 'Dejinta',
        'open_menu' => 'Fur menu-ga',
    ],

    'common' => [
        'back' => 'Dib ugu noqo',
        'sign_in' => 'Gal',
        'sign_in_arrow' => 'Gal →',
        'log_out' => 'Ka bax',
        'register' => 'Isdiiwaangeli',
        'search_placeholder' => 'Raadi eray ama weedh…',
        'learn_more' => 'Wax badan ka ogow',
        'view_all' => 'Dhammaan eeg →',
        'all' => 'Dhammaan',
        'cancel' => 'Ka noqo',
        'save' => 'Kaydi',
        'saved' => 'Waa la kaydiyay.',
        'delete' => 'Tirtir',
        'submit' => 'Gudbi',
        'or' => 'ama',
        'words' => 'eray',
    ],

    'flash' => [
        'bookmark_added' => 'Waxaa lagu daray waxyaabaha la kaydiyay.',
        'bookmark_removed' => 'Waxaa laga saaray waxyaabaha la kaydiyay.',
        'history_cleared' => 'Taariikhda waa la tirtiray.',
        'contribution_published' => 'Mahadsanid! Wax ku darsigaaga waa la daabacay.',
        'contribution_deleted' => 'Wax ku darsiga waa la tirtiray.',
        'google_unconfigured' => 'Gelitaanka Google weli lama dejin. Ku dar GOOGLE_CLIENT_ID / GOOGLE_CLIENT_SECRET faylkaaga .env.',
        'google_failed' => 'Gelitaanka Google wuu fashilmay. Fadlan isku day mar kale.',
    ],

    'tip' => [
        'title' => 'Talo yar',
        'body' => 'Gal si aad erayada u kaydsato oo aad wax ku darsigaaga ugu lifaaqdo eray kasta.',
    ],

    'footer' => [
        'credit' => 'Qaamuuska Af-Soomaaliga · Waxaa diyaariyay Centro Studi Somali, Università Roma Tre',
    ],

    'home' => [
        'title' => 'Raadi erayo',
        'browse_az' => 'Ka dhex baar A–Z',
        'domains' => 'Mawduucyada',
        'results' => 'Natiijooyinka',
        'discover' => 'Sahami',
        'count' => ':count eray',
        'no_matches' => 'Natiijo ku habboon “:query” lama helin.',
        'no_matches_hint' => 'Hubi higgaadda ama isku day eray kale.',
        'word_of_day' => 'Erayga maanta',
        'read_full_entry' => 'Akhri faahfaahinta oo dhan',
        'select_hint' => 'Ka dooro liiska eray aad rabto si aad u aragto faahfaahinta oo dhan.',
    ],

    'browse' => [
        'page_title' => 'Xarafka :letter',
        'heading' => 'Erayada ka bilaabma “:letter”',
    ],

    'domains' => [
        'page_title' => 'Mawduucyada',
        'back_home' => 'Ku noqo bogga hore',
        'heading' => 'Ka baadh mawduuc ahaan',
        'subheading' => ':count mawduuc ayaa ku jira qaamuuska.',
        'word_count' => '{1} :count eray|[2,*] :count eray',
    ],

    'word' => [
        'homonym' => 'isku-dhawaaq :index',
        'bookmark' => 'Kaydi',
        'word_form' => 'Nooca erayga',
        'gender' => 'Lab/dheddig',
        'plural' => 'Jamac',
        'conjugation' => 'Qaabka falka',
        'explanation' => 'Sharaxaad',
        'synonyms' => 'Erayo la macno ah',
        'other_forms' => 'Qaabab kale',
        'no_definition' => 'Micne lama hayo.',
        'see' => 'Eeg:',
        'not_applicable' => 'Ma khuseeyo',
        'unknown' => 'Lama yaqaan',
    ],

    'pos' => [
        'noun' => 'Magac',
        'verb' => 'Fal',
        'adjective' => 'Tilmaame',
        'pronoun' => 'Magac-u-yaal',
        'particle' => 'Qodob',
        'adverb' => 'Fal-tilmaame',
        'exclamation' => 'Yeedhmo',
        'preposition' => 'Horgale',
        'numeral' => 'Tiro',
    ],

    'gender' => [
        'm' => 'Lab',
        'f' => 'Dheddig',
        'b' => 'Lab iyo dheddig',
    ],

    'domain_labels' => [
        'daaw.' => 'Daawo',
        'fiis.' => 'Fiisigis',
        'xis.' => 'Xisaab',
        'baay.' => 'Bayooloji',
        'kiim.' => 'Kiimiko',
        'dii.' => 'Diin',
        'juqr.' => 'Juqraafi',
        'jool.' => 'Jiyooloji',
        'bot.' => 'Botani',
        'muus.' => 'Muusig',
        'siyaa.' => 'Siyaasad',
        'taar.' => 'Taariikh',
        'dhaq.' => 'Ganacsi',
        'c.nafl' => 'Cilmiga xayawaanka',
        'qaan.' => 'Qaanuun',
        'c.naf' => 'Cilmi-nafsi',
    ],

    'contributions' => [
        'heading' => 'Wax ku darsiga bulshada',
        'empty' => 'Weli wax ku darsi bulsho ma jiro. Adiga noqo qofka ugu horreeya ee wax ku dara!',
        'add' => 'Ku dar wax ku darsi',
        'type' => 'Nooca',
        'dialect' => 'Lahjadda (ikhtiyaari)',
        'dialect_placeholder' => 'tusaale: Maxaa-tiri, Maay…',
        'content' => 'Nuxurka',
        'content_placeholder' => 'Ku qor sharaxaad, eray la mid ah, ama weedh tusaale ah…',
        'sign_in_prompt' => 'Si aad wax ugu darto, gal akoonkaaga →',
        'types' => [
            'explanation' => 'Sharaxaad dheeraad ah',
            'synonym' => 'Eray la macno ah',
            'example_sentence' => 'Weedh tusaale ah',
            'dialect_variant' => 'Nooc lahjad ah',
        ],
    ],

    'favorites' => [
        'title' => 'Waxyaabaha la kaydiyay',
        'empty' => 'Weli waxba ma aadan kaydsan.',
        'empty_hint' => 'Riix astaanta kaydka ee eray kasta si aad halkan ugu kaydiso.',
    ],

    'history' => [
        'title' => 'Taariikhda erayada',
        'clear_all' => 'Dhammaan tirtir',
        'confirm_clear' => 'Ma rabtaa inaad tirtirto dhammaan taariikhdaada?',
        'empty' => 'Weli taariikh ma jirto.',
        'empty_hint' => 'Erayada aad eegto halkan ayay ka soo muuqan doonaan.',
    ],

    'account' => [
        'title' => 'Akoonka',
    ],

    'pages' => [
        'about_title' => 'Ku saabsan qaamuuska',
        'grammar_title' => 'Naxwaha Af-Soomaaliga',
        'contents' => 'Tusmo',
        'unavailable' => 'Nuxurka lama heli karo.',
    ],

    'about_online' => [
        'page_title' => 'Qaamuuska onlaynka ah',
        'heading' => 'Ku saabsan qaamuuska onlaynka ah',
        'subheading' => 'Sida loo diyaariyay iyo cidda diyaarisay.',

        'what_heading' => 'Waa maxay qaamuuskani?',
        'what_body' => 'Kani waa nuqul dijitaal ah oo ka mid ah <strong>Qaamuuska Af-Soomaaliga</strong> ee ay daabacday <em>Centro Studi Somali, Università degli Studi Roma Tre</em> (ROMA TRE-PRESS, 2012, ISBN 978-88-97524-02-1). Waxaad si fudud uga raadin kartaa :words eray micnahooda iyo xogtooda naxwe browser kasta.',

        'who_heading' => 'Yaa diyaariyay?',
        'who_intro' => 'Qaamuuska asalka ah waxaa soo diyaariyey koox cilmi-baarayaal ah oo uu hoggaaminayay:',
        'who_puglielli' => '<strong>Annarita Puglielli</strong> — maamulaha mashruuca iyo tafatiraha guud (Università Roma Tre)',
        'who_mansuur' => '<strong>Cabdalla Cumar Mansuur</strong> — tafatiraha guud',
        'who_committee' => '<strong>Guddiga cilmi-baarista</strong> — Axmed Cabdullaahi Axmed, Ciise Maxamed Siyaad, Axmed Cartan Xaange, Maryan Faarax Warsame, Dahabo Faarax Xasan, Cabdi Daahir Afey, iyo kuwo kale',
        'who_editors' => '<strong>Tafatirayaal badan</strong> — kuwa erayada soo ururiyay, fasiray, oo hubiyay',
        'who_note' => 'Mashruucu wuxuu qayb ka ahaa iskaashigii cilmi-baarista ee Talyaani–Soomaali ee <em>Studi Somali</em> ee billowday 1977–78.',

        'built_heading' => 'Sidee loo dhisay daabacaaddan onlaynka ah?',
        'built_intro' => 'Buugga daabacan waxaa loo beddelay xog habaysan iyadoo la adeegsanayo habraaca NLP:',
        'built_extraction' => '<strong>Soo saarid</strong> — qoraalka qaamuuska waxaa laga soo saaray PDF-kii asalka ahaa.',
        'built_parsing' => '<strong>Kala soocid</strong> — eray kasta waxaa loo kala jabiyay eray-madax, nooca erayga, jinsiga, qaabka falka/wadar, iyo micnayaasha kala duwan.',
        'built_structuring' => '<strong>Qaabayn</strong> — xogta waxaa lagu kaydiyay kaydka MySQL — :entries eray iyo :definitions micne.',
        'built_presentation' => '<strong>Bandhigid</strong> — barnaamijkan Laravel wuxuu xogta ku soo bandhigayaa qaab fudud oo la raadin karo.',

        'community_heading' => 'Wax ku darsiga bulshada',
        'community_body' => 'Qaamuusku waa <strong>mid nool</strong>. Isticmaalayaasha diiwaangashan waxay ku dari karaan sharaxaad dheeraad ah, erayo la mid ah, weedho tusaale ah, iyo erayo ka yimid lahjado kala duwan. Wax ku darsiga bulshada si cad ayaa loo calaamadeeyaa, waxaana lagu muujiyaa <span class="text-amber-600 font-medium">hoosta bogga eray kasta</span>, si looga sooco qoraalka qaamuuska asalka ah.',

        'credits_heading' => 'Aqoonsi &amp; shati',
        'credits_body' => 'Nuxurka erayada waxaa iska leh qorayaashii asalka ahaa (Centro Studi Somali, Roma Tre). Daabacaaddan onlaynka ah waxaa loogu talagalay waxbarasho iyo cilmi-baaris. Fadlan xigso ilaha asalka ah markaad isticmaalayso.',
    ],

    'auth' => [
        'name' => 'Magac',
        'email' => 'Iimayl',
        'password' => 'Furaha sirta ah',
        'confirm_password' => 'Xaqiiji furaha sirta ah',
        'current_password' => 'Furaha sirta ah ee hadda',
        'new_password' => 'Furaha cusub',
        'remember_me' => 'I xasuuso',
        'forgot_password' => 'Ma illowday furaha sirta ah?',
        'log_in' => 'Gal',
        'already_registered' => 'Hore ma isdiiwaangelisay?',
        'continue_with_google' => 'Google ku gal',
        'reset_password' => 'Dib u deji furaha sirta ah',
        'email_reset_link' => 'Iimayl igu soo dir xiriiriyaha dib-u-dejinta',
        'forgot_intro' => 'Ma illowday furaha sirta ah? Dhib malaha. Kaliya noo sheeg cinwaankaaga iimaylka, waxaanu kuu soo diri doonaa xiriiriye aad ku dejisan karto mid cusub.',
        'confirm' => 'Xaqiiji',
        'confirm_intro' => 'Tani waa qayb ammaan ah oo barnaamijka ka mid ah. Fadlan xaqiiji furaha sirta ah ka hor intaadan sii wadin.',
        'verify_intro' => 'Waad ku mahadsan tahay isdiiwaangelinta! Ka hor intaadan bilaabin, ma xaqiijin kartaa cinwaankaaga iimaylka adigoo gujinaya xiriiriyaha aan hadda kuu soo dirnay? Haddii aadan weli helin, si farxad leh ayaan mid kale kuu soo diri doonaa.',
        'verify_sent' => 'Xiriiriye xaqiijin cusub ayaa loo diray cinwaanka iimaylka aad bixisay markaad isdiiwaangelinaysay.',
        'resend_verification' => 'Dib u soo dir iimaylka xaqiijinta',
    ],

    'profile' => [
        'information' => 'Xogta akoonka',
        'information_hint' => 'Cusboonaysii xogta akoonkaaga iyo cinwaanka iimaylka.',
        'update_password' => 'Cusboonaysii furaha sirta ah',
        'update_password_hint' => 'Si akoonkaagu u ammaan ahaado, isticmaal furaha sirta ah oo dheer oo ay adag tahay in la qiyaaso.',
        'delete_account' => 'Tirtir akoonka',
        'delete_hint' => 'Marka akoonkaaga la tirtiro, dhammaan xogtiisa iyo agabkiisa si joogto ah ayaa loo tirtiri doonaa. Ka hor intaadan akoonkaaga tirtirin, fadlan soo dejiso wixii xog ah ee aad rabto inaad sii haysato.',
        'delete_confirm_heading' => 'Ma hubtaa inaad rabto inaad akoonkaaga tirtirto?',
        'delete_confirm_hint' => 'Marka akoonkaaga la tirtiro, dhammaan xogtiisa iyo agabkiisa si joogto ah ayaa loo tirtiri doonaa. Fadlan geli furaha sirta ah si aad u xaqiijiso inaad rabto tirtirid joogto ah.',
        'email_unverified' => 'Iimaylkaaga lama xaqiijin.',
        'resend_verification' => 'Halkan guji si aad mar kale u soo dirto iimaylka xaqiijinta.',
        'verification_sent' => 'Xiriiriye xaqiijin cusub ayaa loo diray iimaylkaaga.',
    ],

];
