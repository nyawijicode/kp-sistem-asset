<?php

namespace App\Filament\Resources\AssetInResource\Pages;

use App\Filament\Resources\AssetInResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetIn extends EditRecord
{
    protected static string $resource = AssetInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
