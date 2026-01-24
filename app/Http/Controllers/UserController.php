<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('index');
    }

    public function balance(BalanceRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->update([
            'balance' => $user->balance + $request->amount,
        ]);

        return redirect()->route('profile.index');
    }
}
