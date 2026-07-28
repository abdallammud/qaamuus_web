<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $history = Auth::user()->histories()
            ->with('entry.definitions')
            ->orderByDesc('viewed_at')
            ->paginate(30);

        return view('dictionary.history', compact('history'));
    }

    public function clear()
    {
        Auth::user()->histories()->delete();

        return back()->with('status', __('ui.flash.history_cleared'));
    }
}
