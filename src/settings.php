<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../src/App/Views/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database connection settings
        "db" => [
            "driver" => env('DB_DRIVER','mysql'), 
            "host"   => env('DB_HOST','localhost'),
            "port"   => env('DB_PORT',''),
            "dbname" => env('DB_NAME',''),
            "user"   => env('DB_USER',''),
            "pass"   => env('DB_PASS','')
        ],
    ],
];
