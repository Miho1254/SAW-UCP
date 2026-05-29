<?php

namespace App\Providers;

use App\Hashing\WhirlpoolHasher;
use Illuminate\Support\ServiceProvider;

class WhirlpoolHashServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('hash', function () {
            return new WhirlpoolHasher();
        });
    }
}
