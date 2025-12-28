<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrdersStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Status Pesanan';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '280px';


    protected function getData(): array
    {
        $statuses = ['Menunggu Konfirmasi', 'Diproses', 'Selesai', 'Dibatalkan'];

        $counts = [];
        foreach ($statuses as $status) {
            $counts[] = Order::where('status', $status)->count();
        }

        return [
            'datasets' => [[
                'data' => $counts,
                'backgroundColor' => ['#f59e0b','#3b82f6','#22c55e','#ef4444'],
            ]],
            'labels' => $statuses,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'cutout' => '70%', // makin besar = makin tipis donut
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'boxWidth' => 12,
                    ],
                ],
            ],
        ];
    }


    protected function getType(): string
    {
        return 'doughnut';
    }
}
