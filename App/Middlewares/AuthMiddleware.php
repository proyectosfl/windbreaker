<?php
// App/Middlewares/AuthMiddleware.php

namespace App\Middlewares;

use App\Core\Session;

class AuthMiddleware
{
    public function handle($next)
    {
        $session = new Session();
        if (!$session->has('user_id')) {
            $session->flash('error', 'Debes iniciar sesión para acceder a esta página');
            header('Location: /login');
            exit;
        }
        return $next();
    }
}