<?php

namespace App\Exports;

use App\Models\Order;
use App\Support\OrderColumns;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrdersExport implements FromCollection, WithHeadings, WithStyles
{
    protected $from;
    protected $until;
    protected $status;
    protected array $columns;

    public function __construct($from, $until, $status, array $columns)
    {
        $this->from = $from;
        $this->until = $until;
        $this->status = $status;
        $this->columns = $columns;
    }

    public function collection(): Collection
    {
        return Order::query()
            ->when(
                $this->from,
                fn ($q) =>
                $q->whereDate('created_at', '>=', $this->from)
            )
            ->when(
                $this->until,
                fn ($q) =>
                $q->whereDate('created_at', '<=', $this->until)
            )
            ->when(
                $this->status,
                fn ($q) =>
                $q->where('status', $this->status)
            )
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $row = [];

                foreach ($this->columns as $key) {
                    $row[] = match ($key) {
                        'id' => 'ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
                        'patient' => $order->patient_name ?? '-',
                        'service' => $order->service->name ?? '-',
                        'address' => $order->address ?? '-',
                        'status' => $order->status,
                        'payment' => $order->payment_status,
                        'total' => $order->total_price,
                        'date' => $order->created_at->format('d M Y'),
                    };
                }

                return $row;
            });

    }

    public function headings(): array
    {
        return collect($this->columns)
            ->map(fn ($key) => OrderColumns::all()[$key])
            ->toArray();
    }


    /** BORDER & HEADER STYLE */
    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestCol = $sheet->getHighestColumn();

        // Header bold
        $sheet->getStyle("A1:{$highestCol}1")->getFont()->setBold(true);

        // Border semua cell
        $sheet->getStyle("A1:{$highestCol}{$highestRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        return [];
    }
}
