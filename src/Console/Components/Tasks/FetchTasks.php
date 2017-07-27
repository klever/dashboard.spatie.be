<?php

namespace Spatie\LaravelDashboard\Console\Components\Tasks;

use Illuminate\Console\Command;
use Spatie\LaravelDashboard\Events\Tasks\TasksFetched;
use Spatie\LaravelDashboard\Services\GitHub\GitHubApi;

class FetchTasks extends Command
{
    protected $signature = 'dashboard:fetch-tasks';

    protected $description = 'Fetch team members tasks from GitHub';

    public function handle(GitHubApi $gitHub)
    {
        $fileNames = explode(',', config('dashboard.services.github.files'));

        $contentOfFiles = collect($fileNames)
            ->combine($fileNames)
            ->map(function ($fileName) use ($gitHub) {
                return $gitHub->fetchFileContent('spatie', 'tasks', "{$fileName}.md", 'master');
            })
            ->map(function ($fileInfo) {
                return file_get_contents($fileInfo['download_url']);
            })
            ->map(function ($markdownContent) {
                return markdownToHtml($markdownContent);
            })
            ->toArray();

        event(new TasksFetched($contentOfFiles));
    }
}
