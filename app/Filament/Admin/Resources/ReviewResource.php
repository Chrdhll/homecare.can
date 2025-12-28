<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Manajemen Konten';
    protected static ?string $navigationLabel = 'Ulasan Pelanggan';
    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Ulasan';
    protected static ?string $pluralModelLabel = 'Ulasan';

    public static function canCreate(): bool
    {
        return false;
    }
    /**
     * Admin tidak bisa membuat review
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kita pakai Section biar modern dan terkotak rapi
                Forms\Components\Section::make('Detail Ulasan')
                    ->description('Informasi detail ulasan yang diberikan pelanggan.')
                    ->schema([
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('user_name_display')
                                    ->label('Pelanggan')
                                    ->formatStateUsing(fn ($record): string => $record->user->name ?? '-')
                                    ->disabled()
                                    ->dehydrated(false),

                                Forms\Components\TextInput::make('service_name_display')
                                    ->label('Layanan Diulas')
                                    ->formatStateUsing(fn ($record): string => $record->service->name ?? '-')
                                    ->disabled()
                                    ->dehydrated(false),
                            ])->columns(2),

                        Forms\Components\TextInput::make('rating')
                            ->label('Rating Bintang')
                            ->numeric()
                            ->prefix('⭐') // Kasih ikon di inputnya
                            ->disabled()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('comment')
                            ->label('Isi Komentar')
                            ->rows(4)
                            ->columnSpanFull()
                            ->disabled(),

                        // Ini satu-satunya yang bisa diedit Admin di form
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Tampilkan di Halaman Depan (Featured)')
                            ->helperText('Jika aktif, ulasan ini akan muncul di slider testimoni Home.')
                            ->onIcon('heroicon-m-eye')
                            ->offIcon('heroicon-m-eye-slash')
                            ->onColor('success')
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. INFO PELANGGAN (Stack Image & Text)
                Tables\Columns\ImageColumn::make('user.avatar')
                    ->label('Avatar')
                    ->circular()
                    ->disk('public')
                    ->getStateUsing(function ($record) {
                        return $record->user?->avatar;
                    })
                    ->defaultImageUrl(function ($record) {
                        $name = $record->user?->name ?? 'User';
                        return 'https://ui-avatars.com/api/?name='
                            . urlencode($name)
                            . '&color=FFFFFF&background=111827&size=128';
                    }),


                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->description(fn (Review $record): string => $record->user->email ?? '-') // Email di bawah nama
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // 2. LAYANAN (Badge Biar Keren)
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Layanan')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                // 3. RATING (Visual Bintang)
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => str_repeat('⭐', (int) $state))
                    ->color(fn (string $state): string => match ($state) {
                        '5', '4' => 'success', // Hijau kalau bagus
                        '3' => 'warning',      // Kuning kalau B aja
                        default => 'danger',   // Merah kalau jelek
                    }),

                // 4. KOMENTAR (Limit Text)
                Tables\Columns\TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(40)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        return $column->getState();
                    }),

                // 5. FEATURED SWITCH (Langsung Klik di Tabel)
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Status Featured')
                    ->onColor('success')
                    ->offColor('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Filter Bintang (Rating)
                Tables\Filters\SelectFilter::make('rating')
                    ->options([
                        '5' => '⭐⭐⭐⭐⭐ (5 Bintang)',
                        '4' => '⭐⭐⭐⭐ (4 Bintang)',
                        '3' => '⭐⭐⭐ (3 Bintang)',
                        '2' => '⭐⭐ (2 Bintang)',
                        '1' => '⭐ (1 Bintang)',
                    ])
                    ->label('Filter Rating'),

                // Filter Featured
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Status Featured'),
            ])
            ->actions([
                // Action Group biar rapi kalau menunya banyak
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(), // Lihat Detail
                    Tables\Actions\DeleteAction::make(), // Hapus
                ])
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
            'index' => Pages\ListReviews::route('/'),
            // 'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
