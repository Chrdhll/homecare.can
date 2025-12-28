<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users'; // Ikon User
    protected static ?string $navigationLabel = 'Daftar pengguna';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun')
                    ->description('Data login dan hak akses pengguna.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true), // Cek unik kecuali punya diri sendiri pas edit

                        Forms\Components\Select::make('role')
                            ->label('Role (Hak Akses)')
                            ->options([
                                'admin' => 'Admin (Pengelola)',
                                'pasien' => 'Pasien (Pengguna Biasa)',
                            ])
                            ->required()
                            ->native(false),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable() // Biar bisa intip password pas ngetik
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state)) // Otomatis Hash
                            ->dehydrated(fn ($state) => filled($state)) // Cuma simpan kalau diisi
                            ->rules(['required', 'min:8']) // Minimal 8 karakter
                            ->helperText('Kosongkan jika tidak ingin mengubah password (saat edit).'),
                    ])->columns(2),

                Forms\Components\Section::make('Data Tambahan')
                    ->description('Informasi kontak dan profil.')
                    ->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->label('No. WhatsApp/HP')
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->avatar() // Tampilan bulat
                            ->disk('public')
                            ->disabled()
                            ->dehydrated(false)
                            ->directory('avatars')
                            ->columnSpanFull(),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Foto')
                    ->circular()
                    ->disk('public')
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=FFFFFF&background=111827'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge() // Tampilan Badge warna-warni
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger', // Merah buat Admin
                        'pasien' => 'info',    // Biru buat Pasien
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'admin' => 'Admin',
                        'pasien' => 'Pasien',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label('No. HP')
                    ->default('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Filter biar gampang cari Admin doang atau Pasien doang
                Tables\Filters\SelectFilter::make('role')
                    ->label('Filter Role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'Pasien',
                    ]),
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
            // Bisa tambah relasi 'Orders' disini kalau mau liat history order user langsung
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
