<?php

namespace Spatie\LaravelDashboard\Events\Packagist;

use Spatie\LaravelDashboard\Events\DashboardEvent;

class TotalsFetched extends DashboardEvent
{
    /** @var array */
    public $totals;

    public function __construct(array $totals)
    {
        $this->totals = $totals;
    }

    public function broadcastWith()
    {
        return $this->totals;
    }
}
