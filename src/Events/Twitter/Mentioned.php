<?php

namespace Spatie\LaravelDashboard\Events\Twitter;

use Spatie\LaravelDashboard\Events\DashboardEvent;

class Mentioned extends DashboardEvent
{
    public $tweetProperties;

    public function __construct(array $tweetProperties)
    {
        $this->tweetProperties = $tweetProperties;
    }
}
