<?php
// App/Core/BaseController.php

namespace App\Core;

abstract class BaseController
{
    protected $request;
    protected $view;
    protected $model;
    protected $session;

    public function __construct()
    {
        $this->request = new RequestHandler();
        $this->view = new View();
        $this->session = new Session();
        $this->initModel();
    }

    // Método para inicializar el modelo correspondiente al controlador
    protected function initModel()
    {
        // Por defecto, no hace nada
        // Los controladores que necesiten un modelo sobrescribirán este método
    }

    // Método helper para verificar si el controlador tiene un modelo
    protected function hasModel()
    {
        return isset($this->model);
    }

    // Método helper para renderizar vistas
    protected function render($view, $data = [])
    {
        return $this->view->render($view, $data);
    }

    // Método helper para redireccionar
    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    // Método helper para responder con JSON
    protected function jsonResponse($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}