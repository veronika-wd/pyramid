<?php

namespace App\Services;

use App\Enums\LogTypeEnum;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SlotService
{
    public function getAdminPercent(): float
    {
        return 1 - array_sum(Slot::PERCENTS);
    }

    public function canBuySlot(User $user): bool
    {
        return $user->slots()->count() < 3 && $user->balance >= Slot::PRICE;
    }

    /**
     * @return User[]
     */
    public function getSuperiors(User $user): array
    {
        return [
            $user->parent,
            $user->parent?->parent,
            $user->parent?->parent?->parent,
        ];
    }

    public function buy(User $user): void
    {
        $user->decrement('balance', Slot::PRICE);
        Slot::create(['owner_id' => $user->id]);

        $user->activityLogs()->create([
            'type' => LogTypeEnum::SLOT,
            'balance' => -Slot::PRICE,
        ]);
    }

    /**
     * @param User[] $superiors
     */
    public function superiorsProfit(array $superiors): void
    {
        foreach (Slot::PERCENTS as $index => $percent) {
            $superiors[$index]?->increment('balance', Slot::PRICE * $percent);

            $superiors[$index]?->activityLogs()->create([
                'type' => LogTypeEnum::USER,
                'balance' => Slot::PRICE * $percent,
            ]);
        }
    }

    public function adminProfit(User $user): void
    {
        $adminPercent = $this->getAdminPercent();

        if ($user->id !== 1) {
            $admin = User::find(1);
            $admin->increment('balance', Slot::PRICE * $adminPercent);

            $admin->activityLogs()->create([
                'type' => LogTypeEnum::USER,
                'balance' => Slot::PRICE * $adminPercent,
            ]);
        }
    }

    public function transaction(User $user): void
    {
        DB::transaction(function () use ($user) {
            $user = User::lockForUpdate()->findOrFail($user->id);
            $superiors = $this->getSuperiors($user);

            $this->buy($user);
            $this->superiorsProfit($superiors);
            $this->adminProfit($user);
        });
    }
}
