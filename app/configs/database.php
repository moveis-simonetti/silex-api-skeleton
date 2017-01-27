<?php

return [
    'db.options' => [
        'driver'   => env('DB_DRIVER', 'pdo_mysql'),
        'host'     => env('DB_HOST', 'localhost'),
        'dbname'   => env('DB_NAME', 'skeleton'),
        'user'     => env('DB_USER', 'root'),
        'password' => env('DB_PASSWORD', 'secret'),
        'port'     => env('DB_PORT', '3306'),
    ],
];