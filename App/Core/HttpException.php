<?php
// app/Core/HttpException.php

namespace App\Core;

class HttpException extends \Exception
{
    public function __construct($message, $code = 500)
    {
        parent::__construct($message, $code);
    }
}
