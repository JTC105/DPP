<?php

return [
    'oracle' => [
        'driver'         => 'oracle',
        'tns'            => env('DB_TNS', ''),
        'host'           => env('DB_HOST_SECOND', ''),
        'port'           => env('DB_PORT_SECOND', '1521'),
        'database'       => env('DB_DATABASE_SECOND', ''),
        'username'       => env('DB_USERNAME_SECOND', ''),
        'password'       => env('DB_PASSWORD_SECOND', ''),
        'charset'        => env('DB_CHARSET_SECOND', 'AL32UTF8'),
        'prefix'         => env('DB_PREFIX_SECOND', ''),
        'prefix_schema'  => env('DB_SCHEMA_PREFIX_SECOND', ''),
        'edition'        => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
];
