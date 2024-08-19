<?php
// index.php

require_once __DIR__.'/vendor/autoload.php';

// Autoloader
// spl_autoload_register(function ($class) {
//     $prefix = 'App\\';
//     $base_dir = __DIR__ . '/App/';
//     $len = strlen($prefix);
//     if (strncmp($prefix, $class, $len) !== 0) {
//         return;
//     }
//     $relative_class = substr($class, $len);
//     $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
//     if (file_exists($file)) {
//         require $file;
//     } else {
//         error_log("File not found: $file");
//     }
// });

use App\Core\Config;

// Cargar configuración
Config::load(__DIR__.'/config/config.php');

// Manejo de errores
set_exception_handler(function ($e) {
    error_log($e->getMessage());
    error_log($e->getTraceAsString());
    http_response_code(500);
    echo "Ha ocurrido un error interno. Detalles: " . $e->getMessage();
});

// Al final de index.php
$app = new App\Core\Application();
$app->run();
