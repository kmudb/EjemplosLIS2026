<?php
return [
    'db' => [
        'dsn' => 'mysql:host=127.0.0.1;dbname=library_db;charset=utf8mb4',
        'user' => 'root',
        'pass' => '', // pon tu contraseña
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    ]
];