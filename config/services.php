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

    'pvgis' => [
        'base_url' => env('PVGIS_BASE_URL')
    ],

    'solis' => [
        'base_url' => env('SOLIS_BASE_URL')
    ],

];
