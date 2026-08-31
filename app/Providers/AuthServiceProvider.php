<?php

namespace App\Providers;

use App\Models\Asset;
use App\Models\AssetIn;
use App\Models\AssetOut;
use App\Models\User;
use App\Policies\AssetInPolicy;
use App\Policies\AssetOutPolicy;
use App\Policies\AssetPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Asset::class => AssetPolicy::class,
        AssetIn::class => AssetInPolicy::class,
        AssetOut::class => AssetOutPolicy::class,
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
