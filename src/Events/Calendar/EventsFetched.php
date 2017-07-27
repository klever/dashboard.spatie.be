<?php

namespace Spatie\LaravelDashboard\Events\Calendar;

use Spatie\LaravelDashboard\Events\DashboardEvent;

class EventsFetched extends DashboardEvent
{
    /** @var array */
    public $events;

    public function __construct(array $events)
    {
        $this->events = $events;
    }
}
