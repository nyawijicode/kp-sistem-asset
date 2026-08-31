<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetInResource\Pages;
use App\Models\Asset;
use App\Models\AssetIn;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AssetInResource extends Resource
{
    protected static ?string $model = AssetIn::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    protected static ?string $navigationLabel = 'Aset Masuk';
    protected static ?string $modelLabel = 'Aset Masuk';
    protected static ?string $slug = 'asset-in';
    protected static ?string $pluralModelLabel = 'Aset Masuk';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('asset_id')
                ->label('Aset')
                ->relationship('asset', 'nama_aset')
                ->getOptionLabelFromRecordUsing(fn(Asset $record) => "{$record->nama_aset} ({$record->serial_number})")
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('tanggal')
                ->required()
                ->default(now()),

            Forms\Components\TextInput::make('qty')
                ->numeric()
                ->minValue(1)
                ->required(),

            Forms\Components\TextInput::make('supplier')
                ->maxLength(255),

            Forms\Components\Textarea::make('keterangan')
                ->columnSpanFull(),

            Forms\Components\Hidden::make('user_id')
                ->default(fn() => Filament::auth()->id()),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')->date('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('asset.nama_aset')->label('Aset')->searchable(),
                Tables\Columns\TextColumn::make('asset.serial_number')->label('Serial Number'),
                Tables\Columns\TextColumn::make('qty')->sortable(),
                Tables\Columns\TextColumn::make('supplier'),
                Tables\Columns\TextColumn::make('user.name')->label('Dicatat Oleh'),
            ])
            ->defaultSort('tanggal', 'desc')
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
            'index' => Pages\ListAssetIns::route('/'),
            'create' => Pages\CreateAssetIn::route('/create'),
            'edit' => Pages\EditAssetIn::route('/{record}/edit'),
        ];
    }
}
