<?php

global $container;

use Core\Router;
use Http\Controllers\HomeController;
use Http\Controllers\RegisterController;

try {
    $router = $container->get(Router::class);

    $router->add('GET', '/', [HomeController::class, 'index']);
    $router->add('GET', '/register', [RegisterController::class, 'index', 'guest']);

    $router->run();
} catch (Exception $e) {
}