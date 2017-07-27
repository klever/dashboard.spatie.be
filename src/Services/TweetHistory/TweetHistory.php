<?php

namespace Spatie\LaravelDashboard\Services\TweetHistory;

use Spatie\LaravelDashboard\Events\Twitter\Mentioned;
use Spatie\Valuestore\Valuestore;

class TweetHistory
{
    /** @var \Spatie\Valuestore\Valuestore */
    protected $valuestore;

    public function __construct()
    {
        $this->valuestore = Valuestore::make(storage_path('app/tweetHistory.json'));
    }

    public function handle(Mentioned $event)
    {
        $this->addTweet($event->tweetProperties);
    }

    public function addTweet(array $tweetProperties)
    {
        $tweets = $this->valuestore->get('tweets', []);

        array_unshift($tweets, $tweetProperties);

        $tweets = array_slice($tweets, 0, 50);

        $this->valuestore->put('tweets', $tweets);
    }

    public function getTweets(): array
    {
        return $this->valuestore->get('tweets', []);
    }

    public static function all(): array
    {
        return (new static())->getTweets();
    }
}
