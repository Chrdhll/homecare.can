<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Tampilkan halaman utama (yang berisi formulir).
     * Ganti 'welcome' dengan nama file blade Anda jika berbeda.
     * (Misal: jika file Anda 'resources/views/home.blade.php', ganti jadi 'home')
     */
    public function showPage()
    {
        // Asumsi file blade utama Anda adalah 'welcome.blade.php'
        return view('welcome'); 
    }

    /**
     * Proses pengiriman formulir dari skrip 'php-email-form'.
     */
public function submitForm(Request $request)
    {
        // 1. Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Tentukan email admin (Penerima)
        $adminEmail = "cobain679856@gmail.com"; // Email penerima Anda

        // 3. Kirim email
        try {
            Mail::to($adminEmail)->send(new ContactFormMail($validatedData));

            // 4. JIKA SUKSES: Redirect kembali dengan pesan sukses
           return redirect(url()->previous() . '#contact')
           ->with('success', 'Pesan Anda telah terkirim. Terima kasih!');

        } catch (\Exception $e) {
            
            // 5. JIKA GAGAL: Redirect kembali dengan pesan error
            // (Baris di bawah ini untuk debugging jika perlu)
            // return redirect()->back()->withInput()->with('error', $e->getMessage()); 
            return redirect(url()->previous() . '#contact')
            ->withInput()->with('error', 'Oops! Terjadi kesalahan. Pesan Anda tidak dapat dikirim.');
        }
    }
}