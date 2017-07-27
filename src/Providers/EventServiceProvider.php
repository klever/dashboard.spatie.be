<?php

namespace Spatie\LaravelDashboard;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Spatie\LaravelDashboard\Events\Twitter\Mentioned::class => [
            \Spatie\LaravelDashboard\Services\TweetHistory\TweetHistory::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
