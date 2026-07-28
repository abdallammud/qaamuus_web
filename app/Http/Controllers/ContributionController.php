<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContributionController extends Controller
{
    public function store(Request $request, Entry $entry)
    {
        $validated = $request->validate([
            'type' => ['required', 'in:' . implode(',', array_keys(Contribution::TYPES))],
            'content' => ['required', 'string', 'min:2', 'max:2000'],
            'dialect' => ['nullable', 'string', 'max:80'],
        ]);

        Contribution::create([
            'user_id' => Auth::id(),
            'entry_id' => $entry->id,
            'type' => $validated['type'],
            'content' => $validated['content'],
            'dialect' => $validated['dialect'] ?? null,
            // Auto-published; switch to 'pending' to enable moderation.
            'status' => 'approved',
        ]);

        return back()->with('status', __('ui.flash.contribution_published'));
    }

    public function destroy(Contribution $contribution)
    {
        abort_unless($contribution->user_id === Auth::id(), 403);
        $contribution->delete();

        return back()->with('status', __('ui.flash.contribution_deleted'));
    }
}
