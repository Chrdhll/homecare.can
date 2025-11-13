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
    protected static ?string $navigationLabel = 'Ulasan';
    protected static ?int $navigationSort = 2;


    /**
     * Admin tidak bisa membuat review
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Nama Pasien')
                    ->relationship('user', 'name')
                    ->disabled(), // Tidak bisa diubah
                Forms\Components\Select::make('order_id')
                    ->label('ID Pesanan')
                    ->relationship('order', 'id')
                    ->disabled(),
                Forms\Components\TextInput::make('rating')
                    ->label('Rating (1-5)')
                    ->disabled(),
                Forms\Components\Textarea::make('comment')
                    ->label('Komentar')
                    ->disabled()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Tampilkan di Halaman Utama (Featured)')
                    ->default(false),
            ]);
    }

    /**
     * Tabel untuk mengelola ulasan yang masuk.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_id')
                    ->label('ID Pesanan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->badge() // Tampilkan rating sebagai badge
                    ->color(fn (int $state): string => match ($state) {
                        1, 2 => 'danger',
                        3 => 'warning',
                        4, 5 => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Komentar')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\ToggleColumn::make('is_featured') // Saklar cepat di tabel
                    ->label('Featured'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Untuk mengubah status 'is_featured'
                Tables\Actions\DeleteAction::make(), // Untuk menghapus ulasan spam
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
