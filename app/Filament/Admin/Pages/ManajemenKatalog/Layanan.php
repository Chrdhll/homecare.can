<?php

namespace App\Filament\Admin\Pages\ManajemenKatalog;

use Filament\Pages\Page;

class Layanan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Manajemen Katalog';
    protected static ?string $navigationLabel = 'Layanan';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.admin.pages.manajemen-katalog.layanan';
}