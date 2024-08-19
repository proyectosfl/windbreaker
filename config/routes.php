<?php
// config/routes.php

use App\Middlewares\AuthMiddleware;

$router = $this->router;

$router->addRoute('GET', '/', 'HomeController@index');

$router->addRoute('GET', '/users', 'UserController@index');
$router->addRoute('GET', '/users/:id', 'UserController@show');
$router->addRoute('POST', '/users', 'UserController@create');
$router->addRoute('GET', '/users/search', 'UserController@search');

$router->addRoute('GET', '/dashboard', 'DashboardController@index', [new AuthMiddleware()]);
