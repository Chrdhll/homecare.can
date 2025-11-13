<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ServiceResource\Pages;
use App\Filament\Admin\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    // ==========================================================
    // == INI UNTUK MEMINDAHKAN MENU KE GRUP YANG KITA MAU ==
    // ==========================================================
    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Manajemen Katalog';
    protected static ?string $navigationLabel = 'Layanan';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Layanan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(), // Bikin input ini jadi lebar penuh

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('benefits')
                    ->label('Manfaat (Benefits)')
                    ->helperText('Tulis satu manfaat per baris (tekan Enter agar jadi list di halaman detail).')
                    ->rows(5)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(0),

                Forms\Components\FileUpload::make('gallery')
                    ->label('Galeri Gambar Layanan')
                    ->image()
                    ->multiple() // <-- Bikin jadi multi-upload
                    ->directory('service-gallery') // Simpan di folder baru
                    ->reorderable() // Bisa di-drag & drop urutannya
                    ->appendFiles() // Biar pas diedit, gambar lama nggak hilang
                    ->helperText('Upload satu atau lebih gambar. Gambar pertama akan jadi thumbnail utama.')
                    ->required() // Wajibkan ada minimal 1 gambar
                    ->columnSpanFull(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('gallery')
                    ->label('Gambar')
                    ->square(), // Bikin gambar jadi kotak

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->searchable() // Aktifkan pencarian
                    ->limit(40)
                    ->tooltip(fn (Service $record): string => $record->name),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR') // Format otomatis jadi Rupiah
                    ->sortable(), // Aktifkan pengurutan

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
