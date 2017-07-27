<?php

namespace Spatie\LaravelDashboard\Events\Tasks;

use Spatie\LaravelDashboard\Events\DashboardEvent;

class TasksFetched extends DashboardEvent
{
    /** @var array */
    public $tasks;

    public function __construct(array $tasks)
    {
        $this->tasks = $tasks;
    }
}
