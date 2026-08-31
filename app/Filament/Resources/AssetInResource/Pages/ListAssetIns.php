<?php

namespace App\Filament\Resources\AssetInResource\Pages;

use App\Filament\Resources\AssetInResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetIns extends ListRecords
{
    protected static string $resource = AssetInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('cetak_laporan')
                ->label('Cetak Laporan')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(route('laporan.aset-masuk'))
                ->openUrlInNewTab(),
        ];
    }
}
