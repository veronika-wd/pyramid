<?php

namespace App\Http\Controllers;

use App\Dtos\DepositDto;
use App\Enums\LogTypeEnum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    public function deposit(DepositDto $dto, Request $request): RedirectResponse
    {
        $user = $request->user();

        DB::transaction(function () use ($dto, $user) {
            $user->increment('balance', $dto->amount);

            $user->activityLogs()->create([
                'type' => LogTypeEnum::DEPOSIT,
                'balance' => $dto->amount,
            ]);
        });

        return redirect()->route('profile.index');
    }
}
