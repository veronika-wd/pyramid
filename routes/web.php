<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/register/{user:referral_link}', [RegisterController::class, 'registerForm'])->name('register');
Route::post('/register/{user:referral_link}', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
Route::patch('/profile', [UserController::class, 'balance'])->name('profile.balance');

Route::post('/slots', [SlotController::class, 'store'])->name('slots.store');
