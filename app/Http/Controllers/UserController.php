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
        $slots = $user->slots;

        $firstLvl = User::where('parent_id', $user->id)->get();
        $secondLvl = collect();
        $thirdLvl = collect();

        foreach ($firstLvl as $item) {
            $secondLvl = $secondLvl->merge(User::where('parent_id', $item->id)->get());
        }

        foreach ($secondLvl as $item) {
            $thirdLvl = $thirdLvl->merge(User::where('parent_id', $item->id)->get());
        }

        return view('index', [
            'slots' => $slots,
            'firstLvl' => $firstLvl,
            'secondLvl' => $secondLvl,
            'thirdLvl' => $thirdLvl,
        ]);
    }
}
