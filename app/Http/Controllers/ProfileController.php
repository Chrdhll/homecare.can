<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $user = $request->user();

        // 1. CEK APAKAH USER MINTA HAPUS FOTO
        if ($request->boolean('delete_avatar')) {
            // Hapus file fisik jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Set data avatar jadi null
            $data['avatar'] = null;
        }
        // 2. JIKA TIDAK HAPUS, CEK APAKAH ADA UPLOAD BARU
        elseif ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profil berhasil diperbarui.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        // 🔐 Kalau user PUNYA password (login manual)
        if (!is_null($user->password)) {
            $request->validateWithBag('userDeletion', [
                'password' => ['required'],
            ]);

            if (!Hash::check($request->password, $user->password)) {
                return back()
                    ->withErrors(['password' => 'Password tidak sesuai'], 'userDeletion');
            }
        }

        // 🧾 ANONIMKAN DATA USER (AMAN UNTUK ADMIN & AUDIT)
        $user->update([
            'name'  => 'Akun Dihapus',
            'email' => 'deleted_' . $user->id . '@example.com',
            'phone_number' => null,
            'address' => null,
            'avatar' => null,
        ]);

        // 🚪 Logout dulu
        Auth::logout();

        // 🧹 Hapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 🗑️ Soft delete user
        $user->delete();

        return redirect('/')
            ->with('status', 'Akun berhasil dihapus.');
    }
}
