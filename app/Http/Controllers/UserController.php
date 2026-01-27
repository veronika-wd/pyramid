<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $slots = $request->user()->slots;

        dd($slots);
        return view('index',[
            'slots' => $slots,
        ]);
    }
}
