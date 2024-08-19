<?php
// App/Core/RequestHandler.php

namespace App\Core;

class RequestHandler
{
    protected $get;
    protected $post;

    public function __construct()
    {
        $this->get = $this->sanitizeInputArray($_GET);
        $this->post = $this->sanitizeInputArray($_POST);
    }

    protected function sanitizeInputArray($array)
    {
        $sanitized = [];
        foreach ($array as $key => $value) {
            $sanitized[$key] = $this->sanitizeInput($value);
        }
        return $sanitized;
    }

    protected function sanitizeInput($input)
    {
        if (is_array($input)) {
            return $this->sanitizeInputArray($input);
        }
        return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }

    public function getParam($key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function postParam($key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }
    
    public function allGetParams()
    {
        return $this->get;
    }

    public function allPostParams()
    {
        return $this->post;
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}