<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // --- MULAI MODIFIKASI DI SINI ---
        
        $user = $request->user(); // atau Auth::user();

        // Cek role user
        if ($user->role === 'admin') {
            // Jika admin, arahkan ke path panel Filament
            return redirect()->intended('/admin');
        }

        if ($user->role === 'pasien') {
            // Jika pasien, arahkan ke dashboard pasien (misal /profil)
            return redirect()->intended('/home'); // Ganti dengan route pasien nanti
        }

        // Jika tidak punya role yang jelas, logout dan kembalikan
        Auth::logout();
        return redirect('/login')->withErrors(['email' => 'Anda tidak memiliki hak akses.']);
        
        // --- AKHIR MODIFIKASI ---
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
