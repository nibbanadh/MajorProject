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

    'google' => [
        'client_id' => '893534697526-h9n3s7sd8e1ulqvmcjlvr69nukd01e76.apps.googleusercontent.com',
        'client_secret' => 'Gxc-yFPZ2p04C5lZUsH_PkVr',
        'redirect' => env('APP_URL', null).'callback/google',
      ],

      'facebook' => [
        'client_id' => '1054240551650883',
        'client_secret' => 'a6b08c20f55d99faf1aba978b37338e8',
        'redirect' => env('APP_URL', null).'callback/facebook',
      ],

];
