<?php

namespace App\Http\Controllers;

use App\Models\Service;

use App\Models\Banner;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::with('promotions')
                       ->latest()
                       ->get();

        $banners = Banner::where('is_active', true)
                         ->orderBy('order')
                         ->get();

        return view('index', ['services' => $services, 'banners' => $banners]);
    }

    public function showService(Service $service)
    {
        // Laravel otomatis mengambil data service dari URL (Route Model Binding)
        // Kita tinggal mengirimkan data $service ke view
        return view('services.service_detail', ['service' => $service]);
    }
}
