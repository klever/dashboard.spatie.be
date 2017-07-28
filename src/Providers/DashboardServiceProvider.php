<?php

namespace Spatie\LaravelDashboard;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'dashboard');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->publishes([__DIR__ . '/../../config' => config_path()], 'config');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/dashboard')], 'views');
        $this->publishes([__DIR__ . '/../../resources/assets/fonts' => public_path('fonts')], 'fonts');
        $this->publishes([__DIR__ . '/../../resources/assets/images' => public_path('images/dashboard')], 'images');
        $this->publishes([__DIR__ . '/../../resources/assets/css' => resource_path('assets/sass/dashboard')], 'css');
        $this->publishes([__DIR__ . '/../../resources/assets/js' => resource_path('assets/js/dashboard')], 'js');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/dashboard.php', 'dashboard');

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
            Console\Components\Calendar\FetchCalendarEvents::class,
            Console\Components\GitHub\FetchTotals::class,
            Console\Components\InternetConnection\SendHeartbeat::class,
            Console\Components\Music\FetchCurrentTrack::class,
            Console\Components\Packagist\FetchTotals::class,
            Console\Components\Tasks\FetchTasks::class,
            Console\Components\Twitter\ListenForMentions::class,
            Console\Components\Twitter\ListenForQuotes::class,
            Console\Components\Twitter\SendFakeTweet::class,
            Console\UpdateDashboard::class,
        ]);
    }
}
