<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetIn extends Model
{
    protected $fillable = [
        'asset_id',
        'user_id',
        'tanggal',
        'qty',
        'supplier',
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
