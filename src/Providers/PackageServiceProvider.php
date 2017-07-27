<?php

namespace Spatie\LaravelDashboard;

use Spatie\Tail\TailServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelDashboard\Services\GitHub\GitHubServiceProvider;
use Spatie\GoogleCalendar\GoogleCalendarFacade;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Spatie\GoogleCalendar\GoogleCalendarServiceProvider;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiFacade;
use Spatie\LaravelTwitterStreamingApi\TwitterStreamingApiServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    protected $providersToRegister = [
        TailServiceProvider::class,
        GitHubServiceProvider::class,
        IdeHelperServiceProvider::class,
        GoogleCalendarServiceProvider::class,
        TwitterStreamingApiServiceProvider::class,
    ];

    protected $facadesToRegister = [
        'GoogleCalendar' => GoogleCalendarFacade::class,
        'TwitterStreamingApi' => TwitterStreamingApiFacade::class,
    ];

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->registerProviders();
        $this->registerFacades();
    }

    private function registerProviders()
    {
        collect($this->providersToRegister)->each(function ($provider) {
            $this->app->register($provider);
        });
    }

    private function registerFacades()
    {
        $loader = AliasLoader::getInstance();

        collect($this->providersToRegister)->each(function ($facade, $alias) use ($loader) {
            $loader->alias($alias, $facade);
        });
    }
}
