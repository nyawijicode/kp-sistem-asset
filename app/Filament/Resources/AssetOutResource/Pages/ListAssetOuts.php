<?php

namespace App\Filament\Resources\AssetOutResource\Pages;

use App\Filament\Resources\AssetOutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetOuts extends ListRecords
{
    protected static string $resource = AssetOutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(route('laporan.aset-keluar'))
                ->openUrlInNewTab(),
        ];
    }
}
