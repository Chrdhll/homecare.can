<?php

namespace App\Filament\Admin\Pages\ManajemenPengguna;

use Filament\Pages\Page;

class Notifikasi extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-bell';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?string $navigationLabel = 'Notifikasi';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.admin.pages.manajemen-pengguna.notifikasi';
}