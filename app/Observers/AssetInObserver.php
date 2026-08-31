<?php

namespace App\Observers;

use App\Models\Asset;
use App\Models\AssetIn;

class AssetInObserver
{
    public function created(AssetIn $assetIn): void
    {
        $assetIn->asset()->increment('qty', $assetIn->qty);
    }

    public function updated(AssetIn $assetIn): void
    {
        $originalAssetId = $assetIn->getOriginal('asset_id');
        $originalQty = (int) $assetIn->getOriginal('qty');

        if ($originalAssetId == $assetIn->asset_id) {
            // Aset sama, cukup terapkan selisihnya
            $diff = $assetIn->qty - $originalQty;
            if ($diff !== 0) {
                $assetIn->asset()->increment('qty', $diff);
            }
        } else {
            // Aset yang dipilih berubah: batalkan efek di aset lama, terapkan di aset baru
            Asset::whereKey($originalAssetId)->decrement('qty', $originalQty);
            $assetIn->asset()->increment('qty', $assetIn->qty);
        }
    }

    public function deleted(AssetIn $assetIn): void
    {
        $assetIn->asset()->decrement('qty', $assetIn->qty);
    }
}
