<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlotController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->slots()->count() >= 3) {
            return redirect()->back()->withErrors(['slot' => 'Больше слоты недоступны.']);
        }

        if ($user->balance < Slot::PRICE) {
            return redirect()->back()->withErrors(['slot' => 'Недостаточно средств.']);
        }

        $adminPercent = 1 - array_sum(Slot::PERCENTS);
        $superiors = [
            $user->parent,
            $user->parent?->parent,
            $user->parent?->parent?->parent,
        ];

        DB::transaction(function () use ($user, $superiors, $adminPercent) {
            $user->decrement('balance', Slot::PRICE);
            Slot::create(['owner_id' => $user->id]);

            foreach (Slot::PERCENTS as $index => $percent) {
                $superiors[$index]?->increment('balance', Slot::PRICE * $percent);
            }

            if ($user->id !== 1) {
                User::find(1)->increment('balance', Slot::PRICE * $adminPercent);
            }
        });

        return redirect()->route('profile.index');
    }
}
