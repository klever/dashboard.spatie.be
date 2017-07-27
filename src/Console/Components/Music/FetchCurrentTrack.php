<?php

namespace Spatie\LaravelDashboard\Console\Components\Music;

use Illuminate\Console\Command;
use Spatie\NowPlaying\NowPlaying;
use Spatie\LaravelDashboard\Events\Music\NothingPlaying;
use Spatie\LaravelDashboard\Events\Music\TrackIsPlaying;

class FetchCurrentTrack extends Command
{
    protected $signature = 'dashboard:fetch-current-track';

    protected $description = 'Fetch the currently playing track from lastFm';

    public function handle()
    {
        $lastFm = new NowPlaying(config('dashboard.services.last-fm.api_key'));

        foreach (config('dashboard.services.last-fm.users') as $userName) {
            $currentTrack = $lastFm->getTrackInfo($userName);

            if ($currentTrack) {
                event(new TrackIsPlaying($currentTrack, $userName));

                return;
            }
        }

        event(new NothingPlaying());
    }
}
