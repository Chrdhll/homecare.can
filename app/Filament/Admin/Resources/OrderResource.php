<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder; 
use Illuminate\Support\HtmlString; 
use Filament\Tables\Columns\SelectColumn;
use Filament\Notifications\Notification;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Manajemen Pesanan';
    protected static ?string $navigationLabel = 'Daftar Pesanan';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Pesanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // --- KOLOM KIRI: STATUS & INFO UTAMA ---
                Group::make()->schema([
                    Section::make('Status Pesanan')
                        ->schema([
                            Forms\Components\Select::make('payment_status')
                                ->label('Status Pembayaran')
                                ->options([
                                    'Belum Lunas' => 'Belum Lunas',
                                    'Lunas' => 'Sudah Lunas',
                                ])
                                ->required()
                                ->native(false),

                            Forms\Components\Select::make('status')
                                ->label('Status Pengerjaan')
                                ->options([
                                    'Menunggu Konfirmasi' => 'Menunggu Konfirmasi',
                                    'Diproses' => 'Diproses (Tim Berangkat)',
                                    'Selesai' => 'Selesai',
                                    'Dibatalkan' => 'Dibatalkan',
                                ])
                                ->required()
                                ->native(false),
                        ])->columns(2),

                    Section::make('Informasi Pasien & Layanan')
                        ->schema([
                            Forms\Components\TextInput::make('id')
                                ->label('ID Pesanan')
                                ->formatStateUsing(fn ($state) => '#ORD-' . str_pad($state, 5, '0', STR_PAD_LEFT))
                                ->disabled(),

                            Forms\Components\Select::make('user_id')
                                ->label('Nama Pasien')
                                ->relationship('user', 'name')
                                ->disabled(),

                            Forms\Components\Select::make('service_id')
                                ->label('Layanan')
                                ->relationship('service', 'name')
                                ->disabled(),

                            Forms\Components\DateTimePicker::make('service_schedule')
                                ->label('Jadwal Layanan')
                                ->required()
                                ->native(false)
                                ->seconds(false),
                        ])->columns(2),
                ])->columnSpan(2),

                // --- KOLOM KANAN: LOKASI & RINCIAN HARGA ---
                Group::make()->schema([

                    // 1. SECTION LOKASI
                    Section::make('Lokasi & Alamat')
                        ->icon('heroicon-m-map-pin')
                        ->schema([
                            Forms\Components\Textarea::make('address')
                                ->label('Alamat Lengkap')
                                ->rows(3)
                                ->disabled(),

                            Forms\Components\Textarea::make('notes')
                                ->label('Catatan Pasien')
                                ->rows(2)
                                ->placeholder('Tidak ada catatan')
                                ->disabled(),

                            // FITUR BARU: Tombol Buka Maps (Versi HTML String biar pasti muncul)
                            Placeholder::make('open_maps_btn')
                                ->label('Navigasi')
                                ->content(fn (Order $record) => new HtmlString(
                                    '<a href="http://maps.google.com/maps?q=' . $record->latitude . ',' . $record->longitude . '" 
                                        target="_blank" 
                                        style="display: block; width: 100%; text-align: center; background-color: green; color: white; padding: 8px; border-radius: 8px; font-weight: bold; text-decoration: none;">
                                        Buka di Google Maps
                                    </a>'
                                ))
                                // Hanya muncul jika ada koordinat
                                ->visible(fn (Order $record) => $record->latitude && $record->longitude),

                            Forms\Components\TextInput::make('distance')
                                ->label('Jarak Tempuh')
                                ->suffix('km')
                                ->disabled(),
                        ]),

                    // 2. SECTION RINCIAN HARGA
                    Section::make('Rincian Pembayaran')
                        ->icon('heroicon-m-currency-dollar')
                        ->schema([
                            Forms\Components\TextInput::make('base_price')
                                ->label('Harga Layanan')
                                ->prefix('Rp')
                                ->numeric()
                                ->disabled(),

                            Forms\Components\TextInput::make('discount_amount')
                                ->label('Potongan Diskon')
                                ->prefix('- Rp')
                                ->numeric()
                                ->disabled()
                                ->visible(fn ($state) => $state > 0),

                            Forms\Components\TextInput::make('transport_cost')
                                ->label('Ongkos Kirim')
                                ->prefix('+ Rp')
                                ->numeric()
                                ->disabled(),

                            Forms\Components\Placeholder::make('total_price_display')
                                ->label('Total Tagihan')
                                ->content(fn (Order $record) => 'Rp ' . number_format($record->total_price, 0, ',', '.'))
                                ->extraAttributes(['class' => 'text-xl font-bold text-primary']),
                        ]),
                ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->formatStateUsing(fn ($state) => '#ORD-' . str_pad($state, 5, '0', STR_PAD_LEFT))
                    ->fontFamily('mono')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pasien')
                    ->description(fn (Order $record) => $record->user->phone_number ?? '-')
                    ->searchable()
                    ->weight(FontWeight::Bold),

                Tables\Columns\TextColumn::make('service.name')
                    ->label('Layanan')
                    ->limit(20),

                Tables\Columns\TextColumn::make('discount_amount')
                    ->label('Diskon')
                    ->money('IDR')
                    ->color('danger') // Warna merah biar kelihatan potongan
                    ->weight(FontWeight::Bold)
                    ->prefix('- ') // Kasih tanda minus
                    ->getStateUsing(function (Order $record) {
                        // Hanya tampilkan jika ada diskon
                        return $record->discount_amount > 0 ? $record->discount_amount : null;
                    })
                    ->placeholder('-'),

                SelectColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->options([
                        'Belum Lunas' => 'Belum Lunas',
                        'Lunas' => 'Lunas',
                    ])
                    ->selectablePlaceholder(false) 
                    ->searchable(false)
                    ->afterStateUpdated(function ($record, $state) {
                        Notification::make()
                            ->title('Status Pembayaran Diubah')
                            ->body("Order #{$record->id} sekarang statusnya: {$state}")
                            ->success()
                            ->send();
                    }),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'Menunggu Konfirmasi' => 'Menunggu Konfirmasi',
                        'Diproses' => 'Diproses (Tim Jalan)',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->selectablePlaceholder(false)
                    ->searchable(false)
                    ->disableOptionWhen(fn ($value, $record) => $record->status === 'Selesai' && $value === 'Dibatalkan')
                    ->afterStateUpdated(function ($record, $state) {
                        Notification::make()
                            ->title('Status Diupdate')
                            ->body("Order #{$record->id} -> {$state}")
                            ->info()
                            ->send();
                    }),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR')
                    ->weight(FontWeight::Bold)
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        'Belum Lunas' => 'Belum Lunas',
                        'Lunas' => 'Lunas',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('chat')
                    ->icon('heroicon-m-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn (Order $record) => "https://wa.me/" . preg_replace('/[^0-9]/', '', $record->user->phone_number ?? ''))
                    ->openUrlInNewTab(),

                Tables\Actions\EditAction::make()->label('Kelola'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
