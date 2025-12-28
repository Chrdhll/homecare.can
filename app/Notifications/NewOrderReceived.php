<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;
use Filament\Notifications\Notification as FilamentNotification; // <--- Import Ini

class NewOrderReceived extends Notification
{
    use Queueable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        // Pastikan 'database' ada di sini
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
                    ->subject('Pesanan Baru Masuk #' . $this->order->id)
                    ->greeting('Halo Admin,')
                    ->line('Ada pesanan layanan baru dari pelanggan: ' . $this->order->user->name)
                    ->action('Proses Pesanan', url('/admin/orders/' . $this->order->id . '/edit'));
    }

    // GANTI METHOD toArray JADI toDatabase BIAR LEBIH KUAT
    public function toDatabase(object $notifiable): array
    {
        return FilamentNotification::make()
            ->title('Pesanan Baru Masuk')
            ->body('Pelanggan ' . $this->order->user->name . ' memesan ' . $this->order->service->name)
            ->icon('heroicon-o-shopping-bag')
            ->info() // Warna Info (Biru)
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Lihat')
                    ->url(
                        route('filament.admin.resources.orders.edit', [
                            'record' => $this->order->uuid,
                        ])
                    )
                    ->button(),
            ])
            ->getDatabaseMessage(); 
    }
}
