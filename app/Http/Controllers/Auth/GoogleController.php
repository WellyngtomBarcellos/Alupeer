<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'google_id' => $user->id,
                    'password' => Hash::make('env("GOOGLE_PASSWORD_DEFAULT")')
                ]);

                $newUser->sendEmailVerificationNotification();

                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('popup', 'Serviço temporariamente indisponível.');
        }
    }
}