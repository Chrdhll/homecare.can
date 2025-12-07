<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;

class OrderController extends Controller
{
    public function create(Service $service)
    {
        // Cek Promo Aktif Hari Ini untuk Layanan Ini
        $today = now()->toDateString();
        $activePromo = Promotion::where('service_id', $service->id)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->latest()
            ->first();

        // Hitung Diskon & Harga Akhir
        $discountAmount = 0;
        $priceAfterDiscount = $service->price;

        if ($activePromo) {
            if ($activePromo->discount_type == 'percentage') {
                $discountAmount = ($service->price * $activePromo->discount_value) / 100;
            } else {
                $discountAmount = $activePromo->discount_value;
            }
            $priceAfterDiscount = $service->price - $discountAmount;
            // Pastikan tidak minus
            if ($priceAfterDiscount < 0) {
                $priceAfterDiscount = 0;
            }
        }

        // Ambil setting lokasi admin & harga per km
        $adminLat = settings('admin_latitude', -6.2088); // Default Jakarta
        $adminLng = settings('admin_longitude', 106.8456);
        $pricePerKm = settings('transport_price_per_km', 0);

        $maxDistance = settings('max_distance_km', 20);


        return view('pages.orders.create', [
            'service' => $service,
            'user' => Auth::user(),
            // Kirim data ini ke view untuk diproses JS
            'adminLat' => $adminLat,
            'adminLng' => $adminLng,
            'pricePerKm' => $pricePerKm,
            'maxDistance' => $maxDistance,
            // Kirim data promo ke view
            'activePromo' => $activePromo,
            'discountAmount' => $discountAmount,
            'priceAfterDiscount' => $priceAfterDiscount,
        ]);
    }

    public function store(Request $request, Service $service)
    {
        // 1. Validasi Input
       $request->validate([
            'phone_number' => 'required|string|max:20',
            'schedule_date' => 'required|date|after_or_equal:today',
            'schedule_time' => 'required',
            'address' => 'required|string',
            'notes' => 'nullable|string',
            // Validasi data dari hidden input map
            'transport_cost' => 'required|numeric|min:0',
            'distance' => 'nullable|numeric',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
        ]);

        
$maxDistance = settings('max_distance_km', 20);
if ($request->distance > $maxDistance) {
    return back()
        ->withInput()
        ->with('error', 'Maaf, lokasi Anda terlalu jauh dari jangkauan kami (Maksimal ' . $maxDistance . ' km).');
}


        try {
            DB::beginTransaction();

            // Kita update data user dengan data terbaru yang dia input
            // Jadi besok kalau dia pesan lagi, datanya udah tersimpan
            $user = Auth::user();
            $user->update([
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);


            $fullSchedule = $request->schedule_date . ' ' . $request->schedule_time . ':00';


            // 1. Cek Promo Lagi (Jangan percaya input user)
            $today = now()->toDateString();
            $activePromo = Promotion::where('service_id', $service->id)
                ->where('is_active', true)
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)
                ->latest()
                ->first();

            $discountAmount = 0;
            $promotionId = null;

            if ($activePromo) {
                $promotionId = $activePromo->id;
                if ($activePromo->discount_type == 'percentage') {
                    $discountAmount = ($service->price * $activePromo->discount_value) / 100;
                } else {
                    $discountAmount = $activePromo->discount_value;
                }
            }

            // 2. Hitung Total
            $basePrice = $service->price;
            $transportCost = $request->transport_cost;

            $totalPrice = ($basePrice - $discountAmount) + $transportCost;

            if ($totalPrice < 0) {
                $totalPrice = 0;
            }

            // 3. Simpan Pesanan ke Database
            $order = Order::create([
                'user_id' => Auth::id(),
                'service_id' => $service->id,
                'promotion_id' => $promotionId,
                'service_schedule' => $fullSchedule,
                'address' => $request->address,
                'notes' => $request->notes,

                'base_price' => $basePrice,
                'transport_cost' => $transportCost,
                'discount_amount' => $discountAmount,
                'total_price' => $totalPrice,

                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'distance' => $request->distance,

                'status' => 'Menunggu Konfirmasi',
                'payment_status' => 'Belum Lunas',
                'payment_method' => 'Manual Transfer', // Default
            ]);

            DB::commit();

            // 4. Generate Link WhatsApp
            $waLink = $this->generateWhatsAppLink($order, $service, $request->phone_number, $request->distance);

            // 5. Redirect User ke WhatsApp
            return redirect()->away($waLink);

        } catch (\Exception $e) {
            DB::rollBack();
            // Kembali ke form dengan pesan error jika gagal
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Helper untuk membuat link WhatsApp dengan pesan otomatis
     */
    private function generateWhatsAppLink($order, $service, $patientPhone)
    {
        // Ambil nomor admin dari Settings (pakai helper kita)
        // Bersihkan nomor dari karakter non-angka
        $adminPhone = preg_replace('/[^0-9]/', '', settings('contact_phone', '6282287339437'));

        $timestamp = strtotime($order->service_schedule);
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $namaHari = $hari[date('w', $timestamp)];

        $jadwalLengkap = $namaHari . ', ' . date('d F Y', $timestamp) . ', Pukul ' . date('H:i', $timestamp) . ' WIB';


        // Buat Template Pesan
        $message = "*HALO ADMIN HOMECARE.CAN*\n";
        $message .= "Saya ingin konfirmasi pesanan baru:\n\n";

        $message .= "*ID Pesanan:* #ORD-" . str_pad($order->id, 5, '0', STR_PAD_LEFT) . "\n";
        $message .= "*Nama Pasien:* " . Auth::user()->name . "\n";
        $message .= "*Layanan:* " . $service->name . "\n";

        $message .= "*Pengajuan Jadwal:* " . $jadwalLengkap . "\n";
        $message .= "(Mohon info ketersediaan slot di jam tersebut)\n";

        $message .= "*Lokasi:* " . $order->address . "\n";

        if ($order->distance) {
            $message .= "(Jarak: " . $order->distance . " km)\n";
            // Link Google Maps biar admin gampang cek lokasi
            if ($order->latitude && $order->longitude) {
                $message .= "*Maps:* https://maps.google.com/?q=" . $order->latitude . "," . $order->longitude . "\n";
            }
        }


        $message .= "*Rincian Biaya:*\n";

        $message .= "Layanan: Rp " . number_format($order->base_price, 0, ',', '.') . "\n";

        if ($order->discount_amount > 0) {
            $message .= "Diskon Promo: - Rp " . number_format($order->discount_amount, 0, ',', '.') . "\n";
        }

        $message .= "Ongkir: Rp " . number_format($order->transport_cost, 0, ',', '.') . "\n";
        $message .= "----------------------------------\n";
        $message .= "*TOTAL: Rp " . number_format($order->total_price, 0, ',', '.') . "*\n\n";


        $message .= "Mohon info nomor rekening untuk pembayaran. Terima kasih!";


        // Encode pesan untuk URL
        $encodedMessage = urlencode($message);

        // Return URL lengkap
        return "https://wa.me/{$adminPhone}?text={$encodedMessage}";
    }
}
