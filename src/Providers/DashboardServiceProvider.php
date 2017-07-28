<?php

namespace Spatie\LaravelDashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\LaravelDashboard\Console\UpdateDashboard;
use Spatie\LaravelDashboard\Console\Components\Tasks\FetchTasks;
use Spatie\LaravelDashboard\Console\Components\Twitter\SendFakeTweet;
use Spatie\LaravelDashboard\Console\Components\Twitter\ListenForQuotes;
use Spatie\LaravelDashboard\Console\Components\Twitter\ListenForMentions;
use Spatie\LaravelDashboard\Console\Components\Music\FetchCurrentTrack;
use Spatie\LaravelDashboard\Console\Components\Calendar\FetchCalendarEvents;
use Spatie\LaravelDashboard\Console\Components\InternetConnection\SendHeartbeat;
use Spatie\LaravelDashboard\Console\Components\GitHub\FetchTotals as FetchGithubTotals;
use Spatie\LaravelDashboard\Console\Components\Packagist\FetchTotals as FetchPackagistTotals;

class DashboardServiceProvider extends ServiceProvider
{
    protected $basePath = __DIR__ . '/../../';

    public function boot()
    {
        $this->loadViewsFrom($this->basePath . 'resources/views', 'dashboard');
        $this->loadRoutesFrom($this->basePath . 'routes/web.php');

        $this->publishBasic();
        $this->publishAdvanced();
    }

    private function publishBasic()
    {
        $this->publishes([
            $this->basePath . 'config' => config_path(),
            $this->basePath . 'public' => public_path(),
            $this->basePath . 'resources/assets/fonts' => public_path('fonts'),
            $this->basePath . 'resources/assets/images' => public_path('images/dashboard'),
            $this->basePath . 'resources/views' => resource_path('views/vendor/dashboard'),
        ], 'basic');
    }

    private function publishAdvanced()
    {
        $this->publishes([
            $this->basePath . 'config' => config_path(),
            $this->basePath . 'public' => public_path(),
            $this->basePath . 'resources/assets/fonts' => public_path('fonts'),
            $this->basePath . 'resources/assets/images' => public_path('images/dashboard'),
            $this->basePath . 'resources/assets/css' => resource_path('assets/sass/dashboard'),
            $this->basePath . 'resources/assets/js' => resource_path('assets/js/dashboard'),
            $this->basePath . 'resources/views' => resource_path('views/vendor/dashboard'),
        ], 'advanced');
    }

    public function register()
    {
        $this->mergeConfigFrom($this->basePath . 'config/dashboard.php', 'dashboard');

        $this->registerProviders();
        $this->registerCommands();
    }

    private function registerProviders()
    {
        collect(config('dashboard.service_providers_to_register'))->each(function ($provider) {
            $this->app->register($provider);
        });
    }

    private function registerCommands()
    {
        $this->commands([
            FetchCalendarEvents::class,
            FetchGithubTotals::class,
            SendHeartbeat::class,
            FetchCurrentTrack::class,
            FetchPackagistTotals::class,
            FetchTasks::class,
            ListenForMentions::class,
            ListenForQuotes::class,
            SendFakeTweet::class,
            UpdateDashboard::class,
        ]);
    }
}
