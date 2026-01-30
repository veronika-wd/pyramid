<?php

namespace App\Http\Controllers\Auth;

use App\Dtos\Auth\RegisterDto;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function registerForm(User $user)
    {
        return view('auth.register', ['user' => $user]);
    }

    public function register(RegisterDto $dto, Request $request, User $user)
    {
        $slot = $user->slots()->whereNull('user_id')->first();

        if (!$slot) {
            return redirect()->back()->withInput()->withErrors(['slot' => 'Нет доступных слотов.']);
        }

        $registerUser = User::create([
            'name' => $dto->name,
            'login' => $dto->login,
            'password' => $dto->password,
            'referral_link' => Str::slug($dto->name) . '-' . uniqid(),
            'parent_id' => $user->id,
        ]);

        $slot->update(['user_id' => $registerUser->id]);

        Auth::login($registerUser, $request->boolean('remember'));

        return redirect()->intended(route('profile.index'));
    }
}
