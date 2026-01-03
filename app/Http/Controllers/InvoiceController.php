<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function generate(Order $order)
    {
        // Security: Pastikan hanya pemilik order atau admin yang bisa download
        if (Auth::user()->role !== 'admin' && Auth::id() !== $order->user_id) {
            abort(403);
        }

        // Load View khusus Invoice
        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $order,
            'setting_phone' => settings('contact_phone', '+62 822-8733-9437'),
            'setting_address' => settings('contact_address', 'Kemang, Jakarta Selatan'),
        ]);

        // Set ukuran kertas
        $pdf->setPaper('a4', 'portrait');

        // Download file dengan nama unik

        $id = str_pad($order->id, 5, '0', STR_PAD_LEFT);
        $name = str($order->patient_name)->slug();

        $filename = "INV-{$id}-{$name}.pdf";

        return $pdf->download($filename);


    }
}
