<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetOut extends Model
{
    protected $fillable = [
        'asset_id',
        'user_id',
        'tanggal',
        'qty',
        'penerima',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
