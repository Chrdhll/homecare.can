<?php

namespace App\Filament\Admin\Pages\ManajemenPesanan;

use Filament\Pages\Page;

class Pesanan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Manajemen Pesanan';
    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?int $navigationSort = 10; // Kita kasih angka 10 biar grup ini di atas

    protected static string $view = 'filament.admin.pages.manajemen-pesanan.pesanan';
}