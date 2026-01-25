<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
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
        $slot = $user->slots()->whereNull('user_id')->first();

        if (!$slot) {
            abort(403);
        }

        $registerUser = User::create([
            'name' => $request->name,
            'login' => $request->login,
            'password' => $request->password,
            'referral_link' => Str::slug($request->name) . '-' . uniqid(),
            'parent_id' => $user->id,
        ]);

        $slot->update(['user_id' => $registerUser->id]);

        Auth::login($registerUser, $request->boolean('remember'));

        return redirect()->intended(route('profile.index'));
    }
}
