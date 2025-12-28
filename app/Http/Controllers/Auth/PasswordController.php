<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Cek apakah user punya password sebelumnya (User Normal) atau tidak (User Google)
        $user = $request->user();
        $isGoogleUser = is_null($user->password);


        $validated = $request->validateWithBag('updatePassword', [
                    // Kalau user Google, current_password BOLEH KOSONG (nullable).
                    // Kalau user biasa, WAJIB ISI (required).
                    'current_password' => $isGoogleUser ? ['nullable'] : ['required', 'current_password'],
                    'password' => ['required', Password::defaults(), 'confirmed'],
                ]);


        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
