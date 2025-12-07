<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service; // <-- Import Model Service

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Kirim data ini HANYA ke view 'layouts.template'
        View::composer('layouts.template', function ($view) {
            // Ambil 6 layanan (bisa diubah jumlahnya) untuk menu
            $navServices = Service::orderBy('name', 'asc')->get();

            // Kirim data ke view
            $view->with('navServices', $navServices);
        });
    }
}
