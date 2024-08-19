<?php
// app/Core/Request.php

namespace App\Core;

class Request
{
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace('/windbreaker', '', $uri);
        return $this->sanitizeUri($uri);
    }

    private function sanitizeUri($uri)
    {
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        $uri = rtrim($uri, '/');
        return $uri ?: '/';
    }
}
