<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function index()
    {
        // Ambil semua pesanan milik user yang sedang login
        // Urutkan dari yang terbaru
        $orders = Order::with('service') // Eager load service biar ringan
                    ->where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('pages.orders.history', [
            'orders' => $orders
        ]);
    }
}