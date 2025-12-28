<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Tandai satu notifikasi sudah dibaca, lalu redirect ke linknya
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead(); // Tandai dibaca di DB

        // Ambil link dari data notifikasi (yang kita set di toArray tadi)
        return redirect($notification->data['link'] ?? route('my-orders.index'));
    }

    // Tandai semua sudah dibaca
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}
