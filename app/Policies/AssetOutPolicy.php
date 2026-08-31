<?php

namespace App\Policies;

use App\Models\AssetOut;
use App\Models\User;

class AssetOutPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }
    public function view(User $user, AssetOut $assetOut): bool
    {
        return true;
    }
    public function create(User $user): bool
    {
        return true;
    }
    public function update(User $user, AssetOut $assetOut): bool
    {
        return true;
    }

    public function delete(User $user, AssetOut $assetOut): bool
    {
        return $user->isPimpinan();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isPimpinan();
    }
}
