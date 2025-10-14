<?php

namespace App\Filament\Admin\Pages\ManajemenKatalog;

use Filament\Pages\Page;

class Promosi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Manajemen Katalog';
    protected static ?string $navigationLabel = 'Promosi';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.admin.pages.manajemen-katalog.promosi';
}