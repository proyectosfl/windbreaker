<?php
// index.php

// Autoloader
require_once __DIR__.'/vendor/autoload.php';

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
