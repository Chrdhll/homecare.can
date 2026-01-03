<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        .header {
            width: 100%;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #174272;
        }

        .company-info {
            float: right;
            text-align: right;
            font-size: 12px;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .total-section {
            text-align: right;
        }

        .status-badge {
            padding: 5px 10px;
            background: #eee;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
            color: {{ $order->status == 'Selesai' ? 'green' : 'orange' }};
        }
    </style>
</head>

<body>

    <div class="header">
        <table width="100%" style="margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 10px;">
            <tr>
                <td valign="top" style="text-align: left;">
                    <div class="logo">INVOICE</div>
                </td>
                <td valign="top" style="text-align: right; font-size: 12px;">
                    <strong>Homecare.can</strong><br>
                    {{ $setting_address }}<br>
                    WA: {{ $setting_phone }}<br>
                    Email: admin@homecare.can
                </td>
            </tr>
        </table>
    </div>

    <div class="invoice-details">
        <table width="100%">
            <tr>
                <td style="border:none; padding:0;">
                    <strong>Ditagihkan Kepada:</strong><br>
                    {{ $order->patient_name }}<br>
                    {{ $order->address }}<br>
                    {{ $order->patient_phone  ?? '-' }}
                </td>
                <td style="border:none; padding:0; text-align:right;">
                    <strong>No. Invoice:</strong>
                    INV/{{ date('Y') }}/{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}<br>
                    <strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y') }}<br>
                    <strong>Jadwal:</strong>
                    {{ \Carbon\Carbon::parse($order->service_schedule)->format('d M Y, H:i') }}<br>
                    <strong>Status:</strong> <span class="status-badge">{{ strtoupper($order->status) }}</span>
                </td>
            </tr>
        </table>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Layanan / Deskripsi</th>
                <th style="text-align: right;">Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $order->service->name }}</strong><br>
                    <small>Penanganan medis di rumah pasien</small>
                </td>
                <td style="text-align: right;">Rp {{ number_format($order->base_price, 0, ',', '.') }}</td>
            </tr>
            @if ($order->transport_cost > 0)
                <tr>
                    <td>Biaya Transportasi (Jarak: {{ $order->distance }} km)</td>
                    <td style="text-align: right;">Rp {{ number_format($order->transport_cost, 0, ',', '.') }}</td>
                </tr>
            @endif
            @if ($order->discount_amount > 0)
                <tr>
                    <td style="color: red;">Diskon Promo</td>
                    <td style="text-align: right; color: red;">- Rp
                        {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="total-section">
        <h3>Total Tagihan: Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>
    </div>

    <div style="margin-top: 50px; text-align: center; font-size: 10px; color: #777;">
        <p>Terima kasih telah mempercayakan kesehatan Anda kepada Homecare.can</p>
        <p>Dokumen ini sah dan diterbitkan secara komputerisasi.</p>
    </div>

</body>

</html>
