<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use Illuminate\Http\RedirectResponse;

class BalanceController extends Controller
{
    public function deposit(BalanceRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->increment('balance', $request->amount);
        $user->activityLogs()->create([
            'type' => 'balance',
            'balance' => $request->amount,
        ]);

        return redirect()->route('profile.index');
    }
}
