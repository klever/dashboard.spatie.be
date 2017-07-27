<?php

namespace Spatie\LaravelDashboard\Http\Controllers;

use Artisan;
use Illuminate\Routing\Controller;

class GitHubWebhookController extends Controller
{
    public function gitRepoReceivedPush()
    {
        abort_unless($this->requestSignatureIsValid(), 403);

        Artisan::call('dashboard:fetch-tasks');

        echo 'ok';
    }

    protected function requestSignatureIsValid(): bool
    {
        $gitHubSignature = request()->header('X-Hub-Signature');

        list($usedAlgorithm, $gitHubHash) = explode('=', $gitHubSignature, 2);

        $payload = file_get_contents('php://input');

        $calculatedHash = hash_hmac($usedAlgorithm, $payload, config('dashboard.services.github.hook_secret'));

        return $calculatedHash === $gitHubHash;
    }
}
