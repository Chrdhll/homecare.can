<?php

namespace App\Filament\Admin\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Navigation\NavigationItem;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB; // Kita pakai DB facade

class PengaturanUmum extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.admin.pages.pengaturan-umum';
    protected static ?string $navigationLabel = 'Pengaturan Umum';
    protected static ?string $navigationGroup = 'Pengaturan';

    // Properti untuk menyimpan data form
    public ?array $data = [];

    /**
     * Mengambil data setting awal saat halaman dimuat.
     */
    public function mount(): void
    {
        $settings = DB::table('settings')
                        ->whereIn('key', ['admin_latitude', 'admin_longitude'])
                        ->pluck('value', 'key') // Ambil value berdasarkan key
                        ->toArray();

        $this->form->fill([
            'admin_latitude' => $settings['admin_latitude'] ?? null,
            'admin_longitude' => $settings['admin_longitude'] ?? null,
        ]);
    }

    /**
     * Mendefinisikan form setting.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('admin_latitude')
                    ->label('Latitude Lokasi Awal Admin')
                    ->numeric()
                    ->required()
                    ->helperText('Contoh: -0.9471 (Gunakan titik sebagai pemisah desimal)'),
                TextInput::make('admin_longitude')
                    ->label('Longitude Lokasi Awal Admin')
                    ->numeric()
                    ->required()
                    ->helperText('Contoh: 100.3614 (Gunakan titik sebagai pemisah desimal)'),
            ])
            ->statePath('data'); // Hubungkan form dengan properti $data
    }

    /**
     * Aksi saat tombol "Simpan" ditekan.
     */
    public function save(): void
    {
        $validatedData = $this->form->getState();

        // Simpan atau update data ke tabel settings
        DB::table('settings')->updateOrInsert(
            ['key' => 'admin_latitude'],
            ['value' => $validatedData['admin_latitude']]
        );
        DB::table('settings')->updateOrInsert(
            ['key' => 'admin_longitude'],
            ['value' => $validatedData['admin_longitude']]
        );

        // Kirim notifikasi sukses
        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
