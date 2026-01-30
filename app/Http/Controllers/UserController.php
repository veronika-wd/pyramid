<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $referrals = User::where('parent_id', $user->id)
            ->with('children.children')
            ->get();

        return view('index', [
            'slots' => $user->slots,
            'referrals' => $referrals,
        ]);
    }
}
