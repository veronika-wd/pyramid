<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Redirect;

class LoginController extends Controller
{
    public function loginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $user = User::where('login', $request->login)->first();

        $remember = $request->remember ? 'true' : 'false';

        Auth::login($user, $remember);

        return redirect()->intended(route('profile.index'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->intended(route('login'));
    }
}
