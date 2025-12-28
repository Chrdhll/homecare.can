<?php

namespace App\Support;

class OrderColumns
{
    public static function all(): array
    {
        return [
            'id' => 'ID Order',
            'patient' => 'Nama Pasien',
            'service' => 'Layanan',
            'address' => 'Alamat',
            'status' => 'Status',
            'payment' => 'Pembayaran',
            'total' => 'Total Bayar',
            'date' => 'Tanggal',
        ];
    }
}
