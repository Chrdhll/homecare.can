<?php

namespace App\Filament\Admin\Pages\ManajemenPengguna;

use Filament\Pages\Page;

class Pengguna extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?string $navigationLabel = 'Pengguna';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.admin.pages.manajemen-pengguna.pengguna';
}