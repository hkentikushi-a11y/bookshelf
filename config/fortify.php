<?php

use Laravel\Fortify\Features;

return [
    'guard' => 'web',
    'middleware' => ['web'],
    'auth_middleware' => 'auth',
    'passwords' => 'users',
    'username' => 'email',
    'email' => 'email',
    'lowercase_usernames' => false,
    'home' => '/admin',
    'prefix' => '',
    'domain' => null,
    'views' => false,
    'features' => [],
    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],
    'subdomains' => false,
    'redirects' => [],
    'passwords_timeout' => 60,
];
