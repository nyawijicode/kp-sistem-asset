<?php

namespace App\Observers;

use App\Models\Asset;
use App\Models\AssetOut;

class AssetOutObserver
{
    public function created(AssetOut $assetOut): void
    {
        $assetOut->asset()->decrement('qty', $assetOut->qty);
    }

    public function updated(AssetOut $assetOut): void
    {
        $originalAssetId = $assetOut->getOriginal('asset_id');
        $originalQty = (int) $assetOut->getOriginal('qty');

        if ($originalAssetId == $assetOut->asset_id) {
            $diff = $assetOut->qty - $originalQty;
            if ($diff !== 0) {
                $assetOut->asset()->decrement('qty', $diff);
            }
        } else {
            Asset::whereKey($originalAssetId)->increment('qty', $originalQty);
            $assetOut->asset()->decrement('qty', $assetOut->qty);
        }
    }

    public function deleted(AssetOut $assetOut): void
    {
        $assetOut->asset()->increment('qty', $assetOut->qty);
    }
}
