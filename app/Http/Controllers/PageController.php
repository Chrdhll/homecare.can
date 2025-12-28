<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Banner;
use App\Models\Promotion;
use App\Models\Review;
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


        $testimonials = Review::with('user')
                                  ->where('is_featured', true)
                                  ->latest()
                                  ->take(6)
                                  ->get();



        return view('index', ['services' => $services, 'banners' => $banners, 'activePromos' => $activePromos, 'testimonials' => $testimonials]);
    }

    public function showService(Service $service)
    {

        // $service->load(['reviews.user' => function ($query) {
        //     $query->select('id', 'name', 'avatar'); 
        // }]);

        // 2. Ambil review terbaru (misal limit 10 biar gak kepanjangan)
        
$reviews = $service->reviews()
                           ->with('user')
                           ->latest()
                           ->get();


        // 3. Hitung Statistik
        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;

        // Format rata-rata jadi 1 desimal (contoh: 4.5)
        $averageRating = number_format($averageRating, 1);


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
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'averageRating' => $averageRating,
            'activePromo' => $activePromo,
            'discountedPrice' => $discountedPrice,
            'discountValue' => $discountValue
        ]);
    }
}
