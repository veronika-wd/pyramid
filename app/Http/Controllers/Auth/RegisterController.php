<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function registerForm(User $user)
    {
        return view('auth.register', [
            'user' => $user,
        ]);
    }

    public function register(RegisterRequest $request, User $user)
    {
        if (!$user->slots()->whereNull('user_id')->exists()) {
            abort(403);
        }
        $registerUser = User::create([
            'name' => $request->input('name'),
            'login' => $request->input('login'),
            'password' => $request->input('password'),
            'referral_link' => Str::slug($request->name) . '-' . uniqid(),
            'parent_id' => $user->id,
        ]);

        $user->slots()->whereNull('user_id')->first()->update([
            'user_id' => $registerUser->id,
        ]);

        $remember = $request->remember ? 'true' : 'false';

        Auth::login($registerUser, $remember);

        return redirect()->intended(route('profile.index'));
    }
}
