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

        /** @var User[] $superiors */
        $superiors = [
            $user->parent,
            $user->parent?->parent,
            $user->parent?->parent?->parent,
        ];

        DB::transaction(function () use ($user, $superiors, $adminPercent) {
            $user->decrement('balance', Slot::PRICE);
            $slot = Slot::create(['owner_id' => $user->id]);
            $user->activityLogs()->create([
                'type' => 'slot',
                'balance' => -Slot::PRICE,
            ]);

            foreach (Slot::PERCENTS as $index => $percent) {
                $superiors[$index]?->increment('balance', Slot::PRICE * $percent);
                $superiors[$index]?->activityLogs()->create([
                    'type' => 'user',
                    'balance' => Slot::PRICE * $percent,
                ]);
            }

            if ($user->id !== 1) {
                $admin = User::find(1);
                $admin->increment('balance', Slot::PRICE * $adminPercent);
                $admin->activityLogs()->create([
                    'type' => 'user',
                    'balance' => Slot::PRICE * $adminPercent,
                ]);
            }
        });

        return redirect()->route('profile.index');
    }
}
