<?php

namespace Spatie\LaravelDashboard\Console\Components\InternetConnection;

use Illuminate\Console\Command;
use Spatie\LaravelDashboard\Events\InternetConnection\Heartbeat;

class SendHeartbeat extends Command
{
    protected $signature = 'dashboard:send-heartbeat';

    protected $description = 'Send a heartbeat to the internet connection tile';

    public function handle()
    {
        event(new Heartbeat());
    }
}
