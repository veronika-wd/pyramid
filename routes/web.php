<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register.form-register');
//Route::post('/register/{user}', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form-login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
//Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
//Route::post('/profile', [UserController::class, 'balance'])->name('profile.balance');
