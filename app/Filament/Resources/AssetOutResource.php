<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetOutResource\Pages;
use App\Models\Asset;
use App\Models\AssetOut;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AssetOutResource extends Resource
{
    protected static ?string $model = AssetOut::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-tray';
    protected static ?string $navigationLabel = 'Aset Keluar';
    protected static ?string $modelLabel = 'Aset Keluar';
    protected static ?string $slug = 'asset-out';
    protected static ?string $pluralModelLabel = 'Aset Keluar';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('asset_id')
                ->label('Aset')
                ->relationship('asset', 'nama_aset')
                ->getOptionLabelFromRecordUsing(fn(Asset $record) => "{$record->nama_aset} ({$record->serial_number}) — stok: {$record->qty}")
                ->searchable()
                ->required()
                ->live(),

            Forms\Components\DatePicker::make('tanggal')
                ->required()
                ->default(now()),

            Forms\Components\TextInput::make('qty')
                ->numeric()
                ->minValue(1)
                ->required()
                ->rule(function (Get $get, ?AssetOut $record) {
                    return function (string $attribute, $value, \Closure $fail) use ($get, $record) {
                        $asset = Asset::find($get('asset_id'));
                        if (! $asset) {
                            return;
                        }

                        // Saat edit, stok "tersedia" = stok saat ini + qty lama record ini
                        $stokTersedia = $asset->qty + ($record?->getOriginal('qty') ?? 0);

                        if ($value > $stokTersedia) {
                            $fail("Qty melebihi stok tersedia ({$stokTersedia}).");
                        }
                    };
                }),

            Forms\Components\TextInput::make('penerima')
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
                Tables\Columns\TextColumn::make('penerima'),
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
            'index' => Pages\ListAssetOuts::route('/'),
            'create' => Pages\CreateAssetOut::route('/create'),
            'edit' => Pages\EditAssetOut::route('/{record}/edit'),
        ];
    }
}
