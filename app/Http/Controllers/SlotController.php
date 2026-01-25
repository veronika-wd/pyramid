<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->balance < Slot::PRICE) {
            return redirect()->back()->withErrors(['slot' => 'Недостаточно средств.']);
        }

        Slot::create(['owner_id' => $user->id]);
        $user->decrement('balance', Slot::PRICE);

        return redirect()->route('profile.index');
    }
}
