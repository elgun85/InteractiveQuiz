<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UserController;

//Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::get('/',[HomePageController::class,'homepage'])->name('home');

                        /*      user        */
Route::get('/Login',[UserController::class,'login'])->name('Login');
Route::get('/Register',[UserController::class,'Register'])->name('Register');
