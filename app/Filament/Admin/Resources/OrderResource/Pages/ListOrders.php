<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use App\Filament\Admin\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua Pesanan'),
            
            'belum_lunas' => Tab::make('Belum Lunas')
                ->icon('heroicon-m-banknotes')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'Belum Lunas'))
                ->badge(fn () => $this->getResource()::getModel()::where('payment_status', 'Belum Lunas')->count())
                ->badgeColor('danger'),

            'menunggu' => Tab::make('Perlu Proses')
                ->icon('heroicon-m-clock')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'Lunas')->where('status', 'Menunggu Konfirmasi'))
                ->badge(fn () => $this->getResource()::getModel()::where('payment_status', 'Lunas')->where('status', 'Menunggu Konfirmasi')->count())
                ->badgeColor('warning'),
            
            'selesai' => Tab::make('Selesai')
                ->icon('heroicon-m-check-badge')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Selesai')),
        ];
    }
}
