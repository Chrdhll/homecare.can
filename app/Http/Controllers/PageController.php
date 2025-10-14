<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::with('promotions') // <-- Eager load relasi 'promotions'
                       ->latest()
                       ->take(6)
                       ->get();

    return view('index', ['services' => $services]);
    }

    public function showService(Service $service)
    {
        // Laravel otomatis mengambil data service dari URL (Route Model Binding)
        // Kita tinggal mengirimkan data $service ke view
        return view('services.service_detail', ['service' => $service]);
    }
}
