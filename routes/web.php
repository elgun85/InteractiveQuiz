<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\RoleEnum;

//Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function ()
{
});


Route::get('/', [HomePageController::class, 'homepage'])->name('home'); //->middleware(['role:'.RoleEnum::ADMIN->value])

                                    /*      user        */
Route::get('/Login', [UserController::class, 'login'])->name('Login');
Route::get('/Register', [UserController::class, 'Register'])->name('Register');
Route::get('/Forgot-password', [UserController::class, 'Forgot'])->name('Forgot-password');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
