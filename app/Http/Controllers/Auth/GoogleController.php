<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class GoogleController extends Controller
{
    // Google'a yönləndirən funksiya
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback URL-də məlumatları alan funksiya
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('email', $googleUser->getEmail())->first();

            if($findUser){
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            } else {
                // Yeni istifadəçi qeydiyyatı
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make('google-' . now()), // Şifrə təyin etməli deyilsən, bu təkraredilməzdir.
                ]);

                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong, please try again later.');
        }
    }
}

