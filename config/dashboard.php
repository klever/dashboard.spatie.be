<?php

return [
    'service_providers_to_register' => [
        \Spatie\LaravelDashboard\EventServiceProvider::class,
        \Spatie\LaravelDashboard\BroadcastServiceProvider::class,
        \Spatie\LaravelDashboard\PackageServiceProvider::class,
        \Spatie\LaravelDashboard\CollectionServiceProvider::class,
    ],

    'node_server_address' => 'http://dashboard.spatie.be:6001',

    'services' => [
        'github' => [
            'token' => env('GITHUB_TOKEN'),
            'files' => env('GITHUB_FILES'),
            'hook_secret' => env('GITHUB_HOOK_SECRET'),
            'username' => env('GITHUB_USERNAME', 'spatie'),
            'tasks' => [
                'repo' => 'tasks',
                'branch' => 'master',
            ],
        ],

        'last-fm' => [
            'api_key' => env('LAST_FM_API_KEY'),
            'users' => explode(',', env('LAST_FM_USERS')),
        ],

        'packagist' => [
            'vendor' => env('PACKAGIST_VENDOR'),
        ],

        'twitter' => [
            'listen_for_mentions' => [
                'spatie.be',
                '@spatie_be',
                'github.com/spatie',
            ]
        ]
    ],
];
