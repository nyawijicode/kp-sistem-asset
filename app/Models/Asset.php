<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'nama_aset',
        'serial_number',
        'kategori',
        'satuan',
        'qty',
        'keterangan',
    ];

    public function assetIns()
    {
        return $this->hasMany(AssetIn::class);
    }

    public function assetOuts()
    {
        return $this->hasMany(AssetOut::class);
    }
}
