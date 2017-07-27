<?php

namespace Spatie\LaravelDashboard\Http\Controllers;

use Illuminate\Routing\Controller;
use Spatie\LaravelDashboard\Services\TweetHistory\TweetHistory;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard::dashboard')->with([
            'pusherKey' => config('broadcasting.connections.pusher.key'),

            'pusherCluster' => config('broadcasting.connections.pusher.options.cluster'),

            'initialTweets' => TweetHistory::all(),

            'usingNodeServer' => usingNodeServer(),
        ]);
    }
}
