<?php

return [
    'web_middleware' => ['web', 'auth'],
    'route_prefix' => 'scheduler',
    'enable_web_interface' => true,
    'timezone' => config('app.timezone', 'UTC'),
    'log_output' => true,
    'notifications' => [
        'enabled' => true,
        'mail' => [
            'enabled' => true,
            'to' => env('ADMIN_EMAIL', 'admin@example.com'),
        ],
        'slack' => [
            'enabled' => false,
            'webhook_url' => env('SLACK_WEBHOOK_URL'),
        ],
    ],
];