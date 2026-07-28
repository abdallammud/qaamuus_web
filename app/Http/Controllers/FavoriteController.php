<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Auth::user()->favorites()
            ->with('entry.definitions')
            ->latest()
            ->paginate(30);

        return view('dictionary.favorites', compact('favorites'));
    }

    public function toggle(Request $request, Entry $entry)
    {
        $existing = Favorite::where('user_id', Auth::id())
            ->where('entry_id', $entry->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $state = false;
        } else {
            Favorite::create(['user_id' => Auth::id(), 'entry_id' => $entry->id]);
            $state = true;
        }

        if ($request->wantsJson()) {
            return response()->json(['favorited' => $state]);
        }

        return back()->with('status', __($state ? 'ui.flash.bookmark_added' : 'ui.flash.bookmark_removed'));
    }
}
