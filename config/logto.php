<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Logto Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Logto SSO integration
    |
    */

    'endpoint' => env('LOGTO_ENDPOINT', 'https://your-logto-endpoint.app'),
    'app_id' => env('LOGTO_APP_ID'),
    'app_secret' => env('LOGTO_APP_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    | OAuth scopes to request from Logto
    |
    */
    'scopes' => [
        'openid',
        'profile',
        'offline_access',
        'email',
        'custom_data',
    ],

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | API resources to request access tokens for
    |
    */
    'resources' => [],
];
