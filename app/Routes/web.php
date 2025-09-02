<?php

global $container;

use Core\Router;
use Http\Controllers\HomeController;

try {
    $router = $container->get(Router::class);

    $router->add('GET', '/', [HomeController::class, 'index']);

    $router->run();
} catch (Exception $e) {
}