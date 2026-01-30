<?php

namespace App\Http\Controllers;

use App\Services\SlotService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function __construct(
        private SlotService $slotService,
    )
    {
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (!$this->slotService->canBuySlot($user)) {
            return redirect()->back()->withErrors(['slot' => 'Невозможно купить слот.']);
        }

        $this->slotService->transaction($user);

        return redirect()->route('profile.index');
    }
}
