<?php

global $container;

use Core\Request;
use Core\Router;
use Http\Controllers\Auth\RegisterController;
use Http\Controllers\Auth\SessionController;
use Http\Controllers\HomeController;

try {
    $router = $container->get(Router::class);

    $router->add('GET', '/', [HomeController::class, 'index']);
    $router->add('GET', '/register', [RegisterController::class, 'index', 'guest']);

    $router->add('POST', '/register', function () use ($container) {
        $controller = $container->get(RegisterController::class);
        $request = $container->get(Request::class)->post;
        $controller->register($request);
    }, ['guest']);

    $router->add('GET', '/login', [SessionController::class, 'index', 'guest']);
    $router->add('POST', '/login', function () use ($container) {
        $controller = $container->get(SessionController::class);
        $request = $container->get(Request::class)->post;
        $controller->store($request);
    }, ['guest']);
    $router->add('POST', '/logout', [SessionController::class, 'destroy', 'auth']);

    $router->run();
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}