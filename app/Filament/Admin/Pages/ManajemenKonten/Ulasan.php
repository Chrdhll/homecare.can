<?php

namespace App\Filament\Admin\Pages\ManajemenKonten;

use Filament\Pages\Page;

class Ulasan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationLabel = 'Ulasan';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.admin.pages.manajemen-konten.ulasan';
}