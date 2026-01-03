<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class TopServicesChart extends ChartWidget
{
    protected static ?string $heading = 'Layanan Terpopuler';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = Order::selectRaw('services.name as service, COUNT(*) total')
            ->join('services', 'orders.service_id', '=', 'services.id')
            ->groupBy('services.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'datasets' => [[
                'label' => 'Jumlah Order',
                'data' => $data->pluck('total'),
                'backgroundColor' => '#6366f1',
            ]],
            'labels' => $data->pluck('service'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
