<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '60s';

    protected function getStats(): array
    {
        $startMonth = now()->startOfMonth();
        $endMonth = now()->endOfMonth();

        $revenueThisMonth = Order::where('payment_status', 'Lunas')
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->sum('total_price');

        $ordersThisMonth = Order::whereBetween('created_at', [$startMonth, $endMonth])->count();
        $ordersToday = Order::whereDate('created_at', today())->count();
        $activeUsers = User::where('role', 'pasien')->count();

        return [
            Stat::make('Pendapatan Bulan Ini', 'Rp ' . number_format($revenueThisMonth, 0, ',', '.'))
                ->description('Order lunas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Total Pesanan Bulan Ini', $ordersThisMonth)
                ->description('Semua status')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Pesanan Hari Ini', $ordersToday)
                ->description('Realtime')
                ->descriptionIcon('heroicon-m-bolt')
                ->color('warning'),

            Stat::make('Total Pelanggan', $activeUsers)
                ->description('User terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }
}
