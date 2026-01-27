<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->slots()->count() === 3) {
            return redirect()->back()->withErrors(['slot' => 'Больше слоты недоступны.']);
        }

        $firstLvl = Slot::PRICE * 0.4;
        $secondLvl = Slot::PRICE * 0.3;
        $thirdLvl = Slot::PRICE * 0.1;
        $fourthLvl = Slot::PRICE - ($firstLvl + $secondLvl + $thirdLvl);

        $user->parent()->increment('balance', $firstLvl);
        $user->parent->parent()->increment('balance', $secondLvl);
        $user->parent->parent->parent()->increment('balance', $thirdLvl);
        User::find(1)->increment('balance', $fourthLvl);

        if ($user->balance < Slot::PRICE) {
            return redirect()->back()->withErrors(['slot' => 'Недостаточно средств.']);
        }

        Slot::create(['owner_id' => $user->id]);
        $user->decrement('balance', Slot::PRICE);

        return redirect()->route('profile.index');
    }
}
