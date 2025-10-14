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

            // Cari user berdasarkan google_id, atau buat user baru jika tidak ada
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)), // Buat password acak
            ]);

            Auth::login($user);
            
            // Di sini kita bisa terapkan logika redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/home'); // Ganti ke dashboard pasien nanti

        } catch (\Exception $e) {
            // Kembali ke halaman login jika ada error
            return redirect('/login')->withErrors(['email' => 'Gagal login dengan Google.']);
        }
    }
}