<?php

namespace App\Policies;

use App\Models\AssetIn;
use App\Models\User;

class AssetInPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }
    public function view(User $user, AssetIn $assetIn): bool
    {
        return true;
    }
    public function create(User $user): bool
    {
        return true;
    }
    public function update(User $user, AssetIn $assetIn): bool
    {
        return true;
    }

    public function delete(User $user, AssetIn $assetIn): bool
    {
        return $user->isPimpinan();
    }

    public function deleteAny(User $user): bool
    {
        return $user->isPimpinan();
    }
}
