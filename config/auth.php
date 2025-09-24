<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],


    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],

        'sales' => [
            'driver' => 'session',
            'provider' => 'sales',
        ],

        'customer' => [
            'driver' => 'session',
            'provider' => 'customer',
        ],
    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'sales' => [
            'driver' => 'eloquent',
            'model' => App\Models\Sales::class,
        ],

        'customer' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],

     
    ],

   

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admin'=>[
            'provider' => 'admin',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            // 'throttle' => 60,
            'throttle' => 5 , 
        ],
        'sales'=>[
            'provider' => 'sales',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
