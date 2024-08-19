<?php
// app/Core/Router.php

namespace App\Core;

class Router
{
    private $routes = [];
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addRoute($method, $route, $handler)
    {
        $this->routes[$method][$route] = $handler;
    }

    public function dispatch()
    {
        $method = $this->request->getMethod();
        $uri = $this->request->getUri();

        foreach ($this->routes[$method] as $route => $handler) {
            $pattern = $this->getRegexPattern($route);
            if (preg_match($pattern, $uri, $matches)) {
                // Eliminar índices numéricos
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return $this->executeHandler($handler, $params);
            }
        }

        throw new HttpException("La ruta no existe.", 404);
    }

    private function getRegexPattern($route)
    {
        return "#^" . preg_replace('/\/:([^\/]+)/', '/(?<$1>[^/]+)', $route) . "$#";
    }

    private function executeHandler($handler, $params)
    {
        if (is_callable($handler)) {
            return call_user_func_array($handler, $params);
        }

        list($controller, $method) = explode('@', $handler);
        $controllerClass = "App\\Controllers\\$controller";

        if (!class_exists($controllerClass)) {
            throw new HttpException("El controlador no existe.", 404);
        }

        $controllerInstance = new $controllerClass();

        if (!method_exists($controllerInstance, $method)) {
            throw new HttpException("El método no existe en el controlador.", 404);
        }

        return call_user_func_array([$controllerInstance, $method], $params);
    }
}
