<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order; // Pastikan model Order di-import

class OrderStatusChanged extends Notification
{
    use Queueable;

    public $order;

    // Kita terima data Order pas notifikasi dipanggil
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    // Kirim via Database (Lonceng) dan Mail (Email)
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    // Isi Email
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Update Status Pesanan #' . $this->order->id)
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Status pesanan Anda telah diperbarui.')
            ->line('Status saat ini: ' . strtoupper($this->order->status))
            ->action('Lihat Detail Pesanan', route('my-orders.show', $this->order))
            ->line('Terima kasih telah menggunakan layanan Homecare.can.');
    }

    // Isi Database (Buat Ikon Lonceng di Web)
    public function toArray(object $notifiable): array
    {
        return [
            'order_id' => $this->order->id,
            'title' => 'Status Pesanan Diperbarui',
            'message' => 'Pesanan #' . $this->order->id . ' sekarang berstatus ' . $this->order->status,
            'link' => route('my-orders.show', $this->order),
            'icon' => 'bi-info-circle',
            'icon' => $this->iconByStatus(),
            'color' => $this->colorByStatus(),
        ];
    }

       private function iconByStatus(): string
    {
        return match ($this->order->status) {
            'Menunggu Konfirmasi' => 'bi-hourglass-split',
            'Diproses' => 'bi-truck',
            'Selesai' => 'bi-check-circle-fill',
            'Dibatalkan' => 'bi-x-circle-fill',
            default => 'bi-info-circle',
        };
    }

    private function colorByStatus(): string
    {
        return match ($this->order->status) {
            'Selesai' => 'success',
            'Diproses' => 'primary',
            'Dibatalkan' => 'danger',
            default => 'info',
        };
    }
}
