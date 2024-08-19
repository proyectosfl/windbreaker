<?php
// App/Core/Config.php

namespace App\Core;

class Config
{
    protected static $config;

    public static function load($file)
    {
        self::$config = require $file;
    }

    public static function get($key, $default = null)
    {
        $keys = explode('.', $key);
        $config = self::$config;

        foreach ($keys as $segment) {
            if (isset($config[$segment])) {
                $config = $config[$segment];
            } else {
                return $default;
            }
        }

        return $config;
    }

    public static function set($key, $value)
    {
        $keys = explode('.', $key);
        $config = &self::$config;

        while (count($keys) > 1) {
            $key = array_shift($keys);
            if (!isset($config[$key]) || !is_array($config[$key])) {
                $config[$key] = [];
            }
            $config = &$config[$key];
        }

        $config[array_shift($keys)] = $value;
    }
}