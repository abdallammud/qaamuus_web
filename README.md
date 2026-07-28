# Qaamuuska Af-Soomaaliga — Online Dictionary

A Laravel 13 web application for the **Qaamuuska Af-Soomaaliga** (Centro Studi Somali,
Università Roma Tre, 2012). It serves **46,314 entries / 32,801 definitions** with search,
A–Z browse, grammar reference, user accounts (incl. Google sign-in), favourites, history,
and community contributions. The interface is **bilingual — Somali and English** (see §12).

---

## 1. Requirements

- PHP **8.2+** (developed on 8.5) — XAMPP ships this
- MySQL / MariaDB (XAMPP)
- Composer 2.x
- Node 18+ & npm (only needed to rebuild CSS/JS)

## 2. Install (XAMPP / htdocs)

```bash
# 1. Copy this folder into XAMPP, e.g. /Applications/XAMPP/htdocs/qaamuuska
# 2. From inside the folder:
composer install
cp .env.example .env        # if .env is missing
php artisan key:generate
```

Make sure XAMPP **MySQL is started**, then create the database:

```sql
CREATE DATABASE qaamuuska CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Edit `.env` if your DB credentials differ (defaults assume root / no password):

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=qaamuuska
DB_USERNAME=root
DB_PASSWORD=
```

## 3. Migrate & import the dictionary

```bash
php artisan migrate
php -d memory_limit=1024M artisan dict:import --fresh
```

`dict:import` reads `database/data/qaamuuska_full_v3.json` and populates the
`entries`, `definitions`, and `synonyms` tables. (~30–60s.)

## 4. Build assets

Pre-built assets are included in `public/build`. To rebuild after changing
Blade/CSS:

```bash
npm install
npm run build
```

## 5. Run

**Dev server (simplest):**

```bash
php artisan serve
# http://127.0.0.1:8000
```

**Under Apache (XAMPP):** point the site's document root at the **`public/`**
folder. If you serve from `htdocs/qaamuuska`, browse to
`http://localhost/qaamuuska/public`. For clean URLs, set up a vhost whose
`DocumentRoot` is `.../htdocs/qaamuuska/public`.

---

## 6. Google sign-in (optional — currently disabled)

> **The Google button is commented out.** It is not set up yet, so the login and
> register screens show email/password only. To bring it back, uncomment the
> `@include('partials.google-button')` line in **both**
> `resources/views/auth/login.blade.php` and
> `resources/views/auth/register.blade.php`, then follow the steps below.
> Nothing else was removed — the partial, routes and `GoogleController` are all
> still in place.

1. Create OAuth credentials at <https://console.cloud.google.com> →
   *APIs & Services → Credentials → OAuth client ID (Web application)*.
2. Authorised redirect URI: `http://localhost:8000/auth/google/callback`
   (match your `APP_URL`).
3. Add to `.env`:

```
GOOGLE_CLIENT_ID=xxxx
GOOGLE_CLIENT_SECRET=xxxx
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
```

Email/password registration works without this; once re-enabled, the Google
button shows a friendly message until the credentials are configured.

---

## 7. Project structure

```
app/
  Console/Commands/ImportDictionary.php   # dict:import  (JSON -> MySQL)
  Http/Controllers/
    DictionaryController.php              # home, search, autocomplete, browse, word view
    PageController.php                    # about, grammar, about-online
    FavoriteController.php  HistoryController.php  ContributionController.php
    Auth/GoogleController.php             # Socialite OAuth
  Models/  Entry Definition Synonym Favorite History Contribution User
  Support/DocContent.php                 # loads extracted PDF content
database/
  migrations/                            # entries, definitions, synonyms, favorites,
                                         #   histories, contributions, users(+oauth)
  data/qaamuuska_full_v3.json            # source dataset (46k entries)
lang/
  en/ui.php  so/ui.php                   # every interface string, both languages
  en/*.php   so/*.php                    # auth, passwords, pagination, validation
resources/
  content/about.json                     # Intro.pdf  -> structured sections
  content/grammar.json                   # naxwe.pdf  -> structured sections
  views/
    layouts/dict.blade.php               # app shell + primary sidebar (7 menu items)
    dictionary/ (index, show, browse, favorites, history, partials/contributions)
    pages/ (document, about-online)      # document = secondary subtitle sidebar
    partials/ (searchbar, google-button)
    components/language-switcher.blade.php  # EN / SO toggle in the header
scripts/extract_content.py               # regenerate content/*.json from the PDFs
```

## 8. Sidebar menu

1. **Qaamuuska / Home** — search + A–Z browse + word view
2. **Wax ku saabsan Qaamuuska** — Intro.pdf, with a secondary subtitle sidebar
3. **Naxwaha / Grammar** — naxwe.pdf, with a secondary subtitle sidebar
4. **Qaamuuska Online** — how / by whom this edition was prepared
5. **Kaydka / Favourites** _(login)_
6. **Taariikhda / History** _(login)_
7. **Akoonkayga / Account** _(login / register / Google)_

## 9. Word view fields

Word form (POS) · headword · explanation(s) · other forms (homonyms) each with
their explanation · gender (masculine/feminine for nouns, else n/a) · plural
(or n/a) · conjugation (for verbs). **No phonetics, no audio.** Community
contributions (more explanation, similar words, example sentences, dialect
variants) appear at the **footer**, clearly marked.

## 10. Regenerating PDF content

```bash
pip3 install pymupdf --break-system-packages
python3 scripts/extract_content.py     # writes /tmp/*_content.json
# copy into resources/content/{about,grammar}.json, then:
php artisan cache:clear
```

## 11. Contribution moderation

Contributions are auto-published (`status = approved`). To require review,
change the default in `ContributionController@store` to `'pending'`; the word
view already shows only `approved` ones.

---

## 12. Interface language (Somali / English)

The whole interface — sidebar menu, labels, buttons, form fields, flash messages
and validation errors — is available in **Somali (SO)** and **English (EN)**.
The **dictionary content itself is never translated**: headwords, definitions and
community contributions are shown exactly as recorded.

**Using it.** An `EN | SO` toggle sits in the top bar next to the *Sign in* button
(and on the login / register screens). Clicking it stores the choice in the session
and returns you to the same page.

**How it works.**

| Piece | File |
| --- | --- |
| Supported languages | `app/Support/Locale.php` |
| Applies the choice on every request | `app/Http/Middleware/SetLocale.php` |
| `GET /lang/{locale}` — sets & redirects back | `app/Http/Controllers/LocaleController.php` |
| The toggle itself | `resources/views/components/language-switcher.blade.php` |
| Interface strings | `lang/en/ui.php`, `lang/so/ui.php` |
| Framework strings | `lang/{en,so}/{auth,passwords,pagination,validation}.php` |

First-time visitors get the language from their browser's `Accept-Language`
header, falling back to `APP_LOCALE` in `.env`. Set `APP_LOCALE=so` to make
Somali the default for everyone.

**Adding or changing a string.** Add the key to **both** `lang/en/ui.php` and
`lang/so/ui.php`, then use `__('ui.your.key')` in the view. A test
(`LocaleTest::test_every_interface_string_exists_in_both_languages`) fails if the
two files ever drift apart.

Grammatical labels (part of speech, gender) and subject-domain names are
translated too — see `Entry::posLabel()` / `Entry::domainName()` and the
`ui.pos`, `ui.gender`, `ui.domain_labels` groups. Domain codes contain dots
(`daaw.`), so the group is fetched as an array rather than by dotted key.

---

## 13. Local vs live environments

Two environment files are kept side by side. **Neither is committed** — both are
excluded by `.gitignore`, and no credentials appear anywhere in this repo.

| File | Used by | Purpose |
| --- | --- | --- |
| `.env` | your machine | development — local MySQL, `APP_DEBUG=true`, `APP_ENV=local` |
| `.env.production` | the live server | upload to Hostinger and **rename to `.env`** |
| `.env.example` | new clones | committed template, all secrets blank |

Laravel only ever reads `.env`, so `.env.production` sitting in the project
folder has no effect on local development. Nothing needs swapping.

**Live site:** <https://qaamuus.abdullahi.me> — Hostinger shared hosting, deployed
by GitHub integration, domain root pointed at `public/`.

Key differences in the live file:

- `APP_ENV=production`, `APP_DEBUG=false`, `LOG_LEVEL=error`
- `APP_URL=https://qaamuus.abdullahi.me`
- `APP_LOCALE=so` — the live site greets first-time visitors in Somali
  (local stays `en`; the `EN | SO` toggle works the same in both)
- `SESSION_SECURE_COOKIE=true` — cookies restricted to HTTPS
- Hostinger MySQL credentials. **The DB password contains `#`, so it is quoted**
  in the file — unquoted, dotenv would treat `#` as the start of a comment and
  silently truncate the password, giving a confusing "access denied".

### Deploying

1. Commit and push to `main` (`vendor/` and `public/build` are committed, so the
   host needs neither Composer nor Node — see §7).
2. Pull the new commit in hPanel → Git.
3. `.env` is untracked and stays put across pulls. Keep a backup anyway.

After changing Blade or CSS, run `npm run build` and commit `public/build`, or
the live site keeps serving stale assets.
