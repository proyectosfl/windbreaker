<?php
// config/config.php

return [
    // Configuración de la aplicación
    'app' => [
        'name' => 'Mi Aplicación',
        'env' => 'development', // 'production', 'development', 'testing'
        'debug' => true,
        'url' => 'http://localhost',
        'timezone' => 'America/Mexico_City',
    ],

    // Configuración de la base de datos
    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'mi_aplicacion',
        'username' => 'usuario',
        'password' => 'contraseña',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
    ],

    // Configuración de sesiones
    'session' => [
        'driver' => 'file',
        'lifetime' => 120,
        'expire_on_close' => false,
        'encrypt' => false,
        // 'files' => storage_path('framework/sessions'),
        'connection' => null,
        'table' => 'sessions',
        'store' => null,
        'lottery' => [2, 100],
        'cookie' => 'mi_aplicacion_session',
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'http_only' => true,
        'same_site' => 'lax',
    ],

    // Configuración de correo
    'mail' => [
        'driver' => 'smtp',
        'host' => 'smtp.mailtrap.io',
        'port' => 2525,
        'username' => null,
        'password' => null,
        'encryption' => null,
        'from' => [
            'address' => 'hello@example.com',
            'name' => 'Example',
        ],
    ],

    // Configuración de caché
    // 'cache' => [
    //     'driver' => 'file',
    //     'path' => storage_path('framework/cache'),
    // ],

    // Configuración de logs
    // 'log' => [
    //     'driver' => 'single',
    //     'path' => storage_path('logs/app.log'),
    //     'level' => 'debug',
    // ],

    // Configuración de seguridad
    'security' => [
        'encryption_key' => 'base64:tu_clave_secreta_aqui',
        'cipher' => 'AES-256-CBC',
    ],

    // Configuración de rutas
    'routes' => [
        'api' => [
            'prefix' => 'api',
            'middleware' => ['api'],
        ],
        'web' => [
            'middleware' => ['web'],
        ],
    ],

    // Configuración de servicios externos
    'services' => [
        'google' => [
            'client_id' => '',
            'client_secret' => '',
            'redirect' => 'http://localhost/auth/google/callback',
        ],
    ],
];