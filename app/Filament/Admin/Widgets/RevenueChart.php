<?php


namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Trend Pendapatan 12 Bulan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Order::selectRaw('MONTH(created_at) month, SUM(total_price) total')
            ->where('payment_status', 'Lunas')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $values = [];
        for ($i = 1; $i <= 12; $i++) {
            $values[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [[
                'label' => 'Pendapatan',
                'data' => $values,
                'borderColor' => '#22c55e',
                'backgroundColor' => 'rgba(34,197,94,0.15)',
                'fill' => true,
                'tension' => 0.4,
            ]],
            'labels' => ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
