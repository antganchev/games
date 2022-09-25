<?php

/**
 * Describe all routes
 */

use Router\Router;

$router = new Router();

$router->addRoute([
    'url'        => '/',
    'controller' => 'IndexController',
    'action'     => 'index',
    'name'       => 'game-list',
]);

$router->addRoute([
    'url'        => '/create',
    'controller' => 'IndexController',
    'action'     => 'create',
    'name'       => 'game-create',
]);

$router->setErrorRoute([
    'controller' => 'ErrorController',
    'action'     => 'show404',
]);


$selectedRoute = $router->match(str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER["REQUEST_URI"]));