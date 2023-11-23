<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class LoginController extends Controller
{
    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider) {
        $providerUser = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(['email' => $providerUser->getEmail()], [
            'name' => $providerUser->getName() ?? $providerUser->getNickname(),
            'provider_id' => $providerUser->getId(),
            'provider' => $provider,
            'avatar' => $providerUser->getAvatar(),
        ]);

        Auth::login($user);

        return redirect()->back();
    }

    public function logout() {
        try {
            if (Auth::check()) {
                Auth::logout();
            }
            return redirect()->back();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function testar() {
        if (Auth::check()) {
            return "Logado!";
        } else {
            return "Deslogado!";
        }
    }
}
