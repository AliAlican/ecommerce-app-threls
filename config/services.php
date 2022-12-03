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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'stripe_key' => env('STRIPE_KEY', 'pk_test_51MAezYCOAjB9iIzayVkD5d88KyqGVQOuD73MySQwSs70rDDjQfY9wfvYkwvugkVvQjg336gIU0vzp03ogus8Ch0S00QT7uwDwY'),
        'stripe_secret' => env('STRIPE_SECRET', 'sk_test_51MAezYCOAjB9iIza09up6cKy36ZhtCfyvzIdJgBL0o4AZxm5MfT3nO9mmJqo4RqXuqCTlwlqlBxEJCIlvWp7fiGW005aJIsXLR')
    ]

];
