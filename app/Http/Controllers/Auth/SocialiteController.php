<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            // Email Google itu TRUSTED
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // === USER BARU ===
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'password' => null,
                    'email_verified_at' => now(),
                    'role' => 'pasien',
                ]);
            } else {
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ]);
            }

            Auth::login($user, true);

            return redirect()->intended(
                $user->role === 'admin' ? '/admin' : '/'
            );

        } catch (\Throwable $e) {
            report($e);
            return redirect('/login')->withErrors([
                'email' => 'Gagal login dengan Google.',
            ]);
        }
    }

}
