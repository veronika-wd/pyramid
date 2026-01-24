<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {

    }

    public function registerForm(User $user)
    {
        return view('auth.register');
    }

    public function register()
    {
        return view('index');
    }
}
