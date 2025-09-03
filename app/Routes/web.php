<?php

global $container;

use Core\Request;
use Core\Router;
use Http\Controllers\HomeController;
use Http\Controllers\RegisterController;

try {
    $router = $container->get(Router::class);

    $router->add('GET', '/', [HomeController::class, 'index']);
    $router->add('GET', '/register', [RegisterController::class, 'index', 'guest']);

    $router->add('POST', '/register', function () use ($container) {
        $controller = $container->get(RegisterController::class);
        $request = $container->get(Request::class);
        $controller->register($request);
    });

    $router->run();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}