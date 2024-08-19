<?php
// App/Core/Session.php

namespace App\Core;

class Session
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public function clear()
    {
        session_unset();
        session_destroy();
    }

    public function flash($key, $value)
    {
        $this->set($key, $value);
        $this->set('__flash', array_merge($this->get('__flash', []), [$key]));
    }

    public function getFlash($key, $default = null)
    {
        if ($this->has('__flash') && in_array($key, $this->get('__flash'))) {
            $value = $this->get($key, $default);
            $this->remove($key);
            return $value;
        }
        return $default;
    }

    public function clearFlash()
    {
        if ($this->has('__flash')) {
            foreach ($this->get('__flash') as $key) {
                $this->remove($key);
            }
            $this->remove('__flash');
        }
    }
}