<?php

namespace App\Filament\Admin\Pages\ManajemenKonten;

use Filament\Pages\Page;

class BannerUtama extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationLabel = 'Banner Utama';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.admin.pages.manajemen-konten.banner-utama';
}