<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentOrders extends TableWidget
{
    protected static ?string $heading = 'Pesanan Terbaru';
    protected static ?int $sort = 5;

    protected function getTableQuery(): Builder
    {
        return Order::query()
            ->latest()
            ->limit(5);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }


    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')
                ->label('Pasien'),

            Tables\Columns\TextColumn::make('service.name')->label('Layanan'),

             Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'warning' => 'Menunggu Konfirmasi',
                    'primary' => 'Diproses',
                    'success' => 'Selesai',
                    'danger' => 'Dibatalkan',
                ]),

            Tables\Columns\TextColumn::make('total_price')
                ->label('Total')
                ->money('IDR'),
        ];
    }
}
