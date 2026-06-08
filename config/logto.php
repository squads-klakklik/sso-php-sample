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

    'endpoint' => env('SSO_ENDPOINT', 'https://your-logto-endpoint.app'),
    'app_id' => env('SSO_APP_ID'),
    'app_secret' => env('SSO_APP_SECRET'),

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
        'email',
        'custom_data',
        'urn:logto:scope:organization_roles',
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
