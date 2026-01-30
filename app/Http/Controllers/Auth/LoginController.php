<?php

namespace App\Http\Controllers\Auth;

use App\Dtos\Auth\LoginDto;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function loginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginDto $dto, Request $request): RedirectResponse
    {
        if (
            Auth::attempt([
                'login' => $dto->login,
                'password' => $dto->password
            ], $request->boolean('remember'))
        ) {
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
