<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('social_id', $google_user->getId())->first();
            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'social_id' => $google_user->getId(),
                    'picture' => $google_user->getAvatar(),
                    'social_type' => 'google',
                ]);
                Auth::login($new_user);
                if ($new_user->role_id === 2) {
                    return redirect()->intended('organizer/dashboard');
                }
            } else {
                Auth::login($user);
                if ($user->role_id === 2) {
                    return redirect()->intended('organizer/dashboard');
                }
            }
        } catch (\Throwable $th) {
            dd("something went wrong! " . $th->getMessage());
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $user = User::where('social_id', $facebook_user->getId())->first();
            if (!$user) {
                $new_user = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'social_id' => $facebook_user->getId(),
                    'picture' => $facebook_user->getAvatar(),
                    'social_type' => 'facebook',
                ]);
                Auth::login($new_user);
                if ($new_user->role_id === 2) {
                    return redirect()->intended('organizer/dashboard');
                }
            } else {
                Auth::login($user);
                if ($user->role_id === 2) {
                    return redirect()->intended('organizer/dashboard');
                }
            }
        } catch (\Throwable $th) {
            dd("something went wrong! " . $th->getMessage());
        }
    }

}
