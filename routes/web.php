<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* ---------------------------------------------------------------------------
 | Dictionary / Home
 * ------------------------------------------------------------------------- */
Route::get('/', [DictionaryController::class, 'index'])->name('home');

// Breeze auth flows redirect here after login/verify — send users to the dictionary.
Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');
Route::get('/autocomplete', [DictionaryController::class, 'autocomplete'])->name('dictionary.autocomplete');
Route::get('/browse/{letter}', [DictionaryController::class, 'browse'])->name('dictionary.browse');
Route::get('/domains', [DictionaryController::class, 'domainsPage'])->name('dictionary.domains');
Route::get('/word/{entry}', [DictionaryController::class, 'show'])->name('word.show');

/* ---------------------------------------------------------------------------
 | Interface language (Somali / English)
 * ------------------------------------------------------------------------- */
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

/* ---------------------------------------------------------------------------
 | Static / content pages
 * ------------------------------------------------------------------------- */
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/grammar', [PageController::class, 'grammar'])->name('grammar');
Route::get('/about-online', [PageController::class, 'aboutOnline'])->name('about-online');

/* ---------------------------------------------------------------------------
 | Authenticated user features
 * ------------------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/word/{entry}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::delete('/history', [HistoryController::class, 'clear'])->name('history.clear');

    Route::post('/word/{entry}/contribute', [ContributionController::class, 'store'])->name('contributions.store');
    Route::delete('/contributions/{contribution}', [ContributionController::class, 'destroy'])->name('contributions.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ---------------------------------------------------------------------------
 | Google OAuth
 * ------------------------------------------------------------------------- */
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/auth.php';
