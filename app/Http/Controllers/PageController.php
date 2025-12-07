<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Banner;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::latest()->get();

        $banners = Banner::where('is_active', true)
                         ->orderBy('order')
                         ->get();


        $today = now()->toDateString();

        $activePromos = Promotion::where('is_active', true)
                    ->whereDate('start_date', '<=', $today)
                    ->whereDate('end_date', '>=', $today)
                    ->get()
                    ->keyBy('service_id');


        return view('index', ['services' => $services, 'banners' => $banners, 'activePromos' => $activePromos]);
    }

    public function showService(Service $service)
    {

        $today = now()->toDateString();
        $activePromo = \App\Models\Promotion::where('service_id', $service->id)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->latest()
            ->first();

        // 2. Hitung harga diskon (untuk dikirim ke view)
        $discountedPrice = null;
        $discountValue = 0;

        if ($activePromo) {
            if ($activePromo->discount_type == 'percentage') {
                $discountValue = ($service->price * $activePromo->discount_value) / 100;
            } else {
                $discountValue = $activePromo->discount_value;
            }
            $discountedPrice = $service->price - $discountValue;
        }

        return view('pages.service_detail', [
            'service' => $service,
            'activePromo' => $activePromo,
            'discountedPrice' => $discountedPrice,
            'discountValue' => $discountValue
        ]);
    }
}
