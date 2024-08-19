<?php
// App/Core/View.php

namespace App\Core;

class View
{
    public function render($view, $data = [])
    {
        extract($data);
        $viewFile = __DIR__ . "/../Views/{$view}.php";
        
        if (!file_exists($viewFile)) {
            throw new \Exception("View file not found: {$viewFile}");
        }

        ob_start();
        include $viewFile;
        return ob_get_clean();
    }
}