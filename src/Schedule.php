<?php

namespace Spatie\LaravelDashboard;

use Illuminate\Console\Scheduling\Schedule;

class DashboardSchedule
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function handle()
    {
        $this->schedule->command('dashboard:fetch-calendar-events')->everyMinute();
        $this->schedule->command('dashboard:fetch-current-track')->everyMinute();
        $this->schedule->command('dashboard:send-heartbeat')->everyMinute();
        $this->schedule->command('dashboard:fetch-tasks')->everyFiveMinutes();
        $this->schedule->command('dashboard:fetch-github-totals')->everyThirtyMinutes();
        $this->schedule->command('dashboard:fetch-packagist-totals')->hourly();
    }
}
