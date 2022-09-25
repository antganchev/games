<?php

$config = [
    'db' => [
        'host' => 'db',
        'port' => '3306',
        'db'   => 'alphawin',
        'user' => 'alphawin',
        'pass' => 'alphawin',
        'charset' => 'utf8mb4',
    ],
    'view_dir' => __DIR__ . '/../views/',
    'file_uploads_paths' => [
        'games' => __DIR__ . '/../public/uploads/games'
    ],
    'file_uploads_urls' => [
        'games' => '/uploads/games'
    ],

];