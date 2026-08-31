<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;
    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Daftar Aset';
    protected static ?string $modelLabel = 'Aset';
    protected static ?string $pluralModelLabel = 'Daftar Aset';
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_aset')
                ->label('Nama Aset')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('serial_number')
                ->label('Serial Number')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Forms\Components\TextInput::make('kategori')
                ->maxLength(255),

            Forms\Components\TextInput::make('satuan')
                ->default('unit')
                ->required()
                ->maxLength(50),

            Forms\Components\TextInput::make('qty')
                ->label('Qty Awal')
                ->numeric()
                ->default(0)
                ->required()
                // qty hanya boleh ditentukan saat aset dibuat.
                // Setelah itu, perubahan qty WAJIB lewat menu Aset Masuk / Aset Keluar.
                ->disabled(fn(string $context) => $context === 'edit')
                ->dehydrated(fn(string $context) => $context === 'create'),

            Forms\Components\Textarea::make('keterangan')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_aset')->searchable()->label('Nama Aset')->sortable(),
                Tables\Columns\TextColumn::make('serial_number')->label('Serial Number')->searchable(),
                Tables\Columns\TextColumn::make('kategori')->searchable(),
                Tables\Columns\TextColumn::make('qty')->sortable(),
                Tables\Columns\TextColumn::make('satuan'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime('d/m/Y H:i')->label('Terakhir Diubah'),
            ])
            ->filters([])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
