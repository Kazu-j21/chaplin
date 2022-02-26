<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'chatwork' => [
        'key' => env('CHATWORK_API_KEY'),
        'url' => env('CHATWORK_API_URL'),
        'room' => env('CHATWORK_ROOM_ID'),
    ],

    // ビヨンド認証システム情報
    'bydauth' => [
        'login' => env('BYD_AUTH_LOGIN_URL'),
        'users' => env('BYD_AUTH_USERS_URL'),
        'group_id' => env('BYD_GROUP_ID'),
    ],

];
