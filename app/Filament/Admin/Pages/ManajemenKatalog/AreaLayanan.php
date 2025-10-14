<?php

namespace App\Filament\Admin\Pages\ManajemenKatalog;

use Filament\Pages\Page;

class AreaLayanan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Manajemen Katalog';
    protected static ?string $navigationLabel = 'Area Layanan';
    protected static ?int $navigationSort = 2;
    
    protected static string $view = 'filament.admin.pages.manajemen-katalog.area-layanan';
}