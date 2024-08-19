<?php
// app/Core/Application.php

namespace App\Core;

class Application
{
    private $router;
    private $request;

    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->loadRoutes();
    }

    private function loadRoutes()
    {
        require_once __DIR__ . '/../../config/routes.php';
    }

    public function run()
    {
        try {
            $this->router->dispatch();
        } catch (\Exception $e) {
            $this->handleException($e);
        }
    }

    private function handleException(\Exception $e)
    {
        if ($e instanceof HttpException) {
            http_response_code($e->getCode());
            echo json_encode(['error' => $e->getMessage()]);
        } else {
            throw $e; // Dejar que el manejador global de excepciones lo maneje
        }
    }
}
