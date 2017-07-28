<?php

namespace Spatie\LaravelDashboard\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Broadcast::routes();

        Broadcast::channel('dashboard', function (User $user) {
            return true;
        });
    }
}
