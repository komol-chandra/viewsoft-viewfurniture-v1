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

    'mailgun'  => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses'      => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google'   => [
        'client_id'     => '732396987641-n1pfgo7gp2adptt4erc3krnr3ta1k9vp.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'http://localhost:8000/callback/google',
    ],

    'facebook' => [
        'client_id'     => '220811240238361',
        'client_secret' => '698b2be0d2b75359da218d65c679735d',
        'redirect'      => 'http://localhost:8000/auth/facebook/callback',
    ],

];
