<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // Ambil data dari formulir
        $subjek = $this->data['subject'];
        $email_pengirim = $this->data['email'];
        $nama_pengirim = $this->data['name'];

        // Ambil email pengirim default (Mrican.ac@gmail.com) dari .env
        $from_address = config('mail.from.address');
        $from_name = config('mail.from.name');

        return $this
            // Kirim DARI email Anda yang terverifikasi di Brevo
            ->from($from_address, $from_name) 

            // Atur 'Balas Ke' (Reply-To) ke email pengguna
            ->replyTo($email_pengirim, $nama_pengirim) 

            ->subject("Pesan Kontak Baru: $subjek") // Atur subjek
            ->view('emails.contact-form'); // Tentukan file Blade untuk isi email
    }
}