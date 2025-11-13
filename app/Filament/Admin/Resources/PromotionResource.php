<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PromotionResource\Pages;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Manajemen Katalog';
    protected static ?string $navigationLabel = 'Promosi';
    protected static ?int $navigationSort = 3; // Urutan ke-3


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Promosi')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                // Dropdown untuk memilih Layanan
                Forms\Components\Select::make('service_id')
                    ->label('Berlaku untuk Layanan')
                    ->relationship('service', 'name')
                    ->searchable()
                    ->preload() // <-- 1. TAMBAHKAN INI BIAR NGGAK PERLU NYARI DULU
                    ->required(),

                // Dropdown untuk Tipe Diskon
                Forms\Components\Select::make('discount_type')
                    ->label('Tipe Diskon')
                    ->options([
                        'percentage' => 'Persentase (%)',
                        'fixed' => 'Nominal Tetap (Rp)',
                    ])
                    ->required()
                    ->reactive(),

                Forms\Components\TextInput::make('discount_value')
                    ->label('Besar Diskon')
                    ->required()
                    ->numeric()
                    ->prefix(fn (Forms\Get $get): ?string => $get('discount_type') === 'percentage' ? '%' : 'Rp')
                    ->minValue(0),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->columnSpanFull(),

                // Kalender untuk Tanggal
                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->displayFormat('d/M/Y') // <-- 2. UBAH FORMAT TAMPILAN FORM
                    ->native(false)
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Berakhir')
                    ->displayFormat('d/M/Y') // <-- 3. UBAH FORMAT TAMPILAN FORM
                    ->native(false)
                    ->required()
                    ->after('start_date'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->required()
                    ->default(true)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Promosi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('service.name')
                    ->label('Layanan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount_value')
                    ->label('Besar Diskon')
                    ->formatStateUsing(function ($state, Promotion $record): string {
                        $value = (float) $state;
                        if ($record->discount_type === 'percentage') {
                            return number_format($value, 0, ',', '.') . '%';
                        } else {
                            return 'Rp ' . number_format($value, 2, ',', '.');
                        }
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d/M/Y') // <-- 4. UBAH FORMAT TAMPILAN TABEL
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Berakhir')
                    ->date('d/M/Y') // <-- 5. UBAH FORMAT TAMPILAN TABEL
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
