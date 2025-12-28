<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order)
    {
        // 1. Validasi Input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // 2. Validasi Keamanan (Cek Hak Milik & Status)
        if ($order->user_id !== Auth::id()) {
            return back()->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
        }

        if ($order->status !== 'Selesai') {
            return back()->with('error', 'Anda hanya bisa mengulas pesanan yang sudah selesai.');
        }

        if ($order->review) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        // 3. Simpan Review
        Review::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'service_id' => $order->service_id, // Ambil dari relasi order
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }

    public function edit(Order $order)
    {
        // 1. Pastikan order milik user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        // 2. Pastikan order selesai
        if ($order->status !== 'Selesai') {
            return redirect()
                ->route('my-orders.show', $order)
                ->with('error', 'Ulasan hanya bisa diedit untuk pesanan selesai.');
        }

        // 3. Pastikan review ada
        $review = $order->review;
        if (!$review) {
            abort(404, 'Ulasan tidak ditemukan');
        }

        return view('pages.reviews.edit', compact('order', 'review'));
    }

    // =========================
    // UPDATE REVIEW
    // =========================
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Security
        if ($order->user_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        if (!$order->review) {
            return back()->with('error', 'Ulasan tidak ditemukan.');
        }

        $order->review->update([
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan berhasil diperbarui.');
    }

}
