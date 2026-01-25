<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function loginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password], $request->boolean('remember'))) {
            return redirect()->intended(route('profile.index'));
        }

        return redirect()->back()->withInput()->withErrors(['auth' => 'Неверный логин или пароль.']);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->intended(route('login'));
    }
}
