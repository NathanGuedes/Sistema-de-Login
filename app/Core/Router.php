<?php

namespace Core;

use Closure;
use Contracts\ControllerInterface;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Http\Controllers\Errors\MethodNotAllowedController;
use Http\Controllers\Errors\NotFoundController;
use Http\Middleware\Middleware;
use function FastRoute\simpleDispatcher;

class Router
{
    private array $routes;
    private array $group;
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function group(string $prefix, Closure $callback): void
    {
        $this->group[$prefix] = $callback;
    }

    public function add(string $requestMethod, string $uri, array $controller, array $middleware = []): void
    {
        $this->routes[] = [$requestMethod, $uri, $controller, $middleware];
    }

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $r) {

            if (!empty($this->group)) {
                $this->groupRoutes($r);
            }

            foreach ($this->routes as $route) {
                $r->addRoute(...$route);
            }
        });

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $uri = $uri !== '/' ? rtrim($uri, '/') : $uri;


        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        $this->validatedMiddleware($uri);

        $this->handler($routeInfo);
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function handler(array $routeInfo): void
    {
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:

                $controller = NotFoundController::class;
                $method = 'index';
                $vars = [];
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:

                $controller = MethodNotAllowedController::class;
                $method = 'index';
                $vars = [];
                break;

            case Dispatcher::FOUND:

                [, [$controller, $method], $vars] = $routeInfo;
                break;
        }

        /** @var string $controller */
        $controller = $this->container->get($controller);
        assert($controller instanceof ControllerInterface);

        /** @var string $method */
        /** @var array $vars */
        $response = $controller->$method(...$vars);

        $response->send();
    }

    /**
     * @param RouteCollector $r
     * @return void
     */
    function groupRoutes(RouteCollector $r): void
    {
        foreach ($this->group as $prefix => $routes) {
            $r->addGroup($prefix, function (RouteCollector $r) use ($routes) {
                foreach ($routes() as $route) {
                    $r->addRoute(...$route);
                }
            });
        }
    }

    /**
     * @param string $uri
     * @return void
     * @throws Exception
     */
    public function validatedMiddleware(string $uri): void
    {
        foreach ($this->routes as $route) {
            if ($uri === $route[1] && !empty($route[3])) {
                foreach ($route[3] as $key) {
                    Middleware::resolve($key);
                }
            }
        }
    }
}