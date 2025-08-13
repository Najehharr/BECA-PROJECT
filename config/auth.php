<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Add a guard for Inspecteur
        'inspecteur' => [
            'driver' => 'session',
            'provider' => 'inspecteurs',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Add a provider for Inspecteur
        'inspecteurs' => [
            'driver' => 'eloquent',
            'model' => App\Models\Inspecteur::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        // Add password reset config for Inspecteur (optional)
        'inspecteurs' => [
            'provider' => 'inspecteurs',
            'table' => 'inspecteur_password_resets', // create this table if needed
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
