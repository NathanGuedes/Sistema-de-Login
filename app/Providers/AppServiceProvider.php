<?php

namespace Providers;

use Contracts\UserRepositoryInterface;
use Core\Request;
use Database\DatabaseConnection;
use PDO;
use Repository\UserRepository;
use Services\UserService;

class AppServiceProvider
{
    public static function definitions(): array
    {
        return [
            PDO::class => function () {
                return DatabaseConnection::connect();
            },
            UserRepositoryInterface::class => \DI\autowire(UserRepository::class),

            UserService::class => \DI\autowire(),

            Request::class => function () {
                return Request::create();
            },
        ];
    }
}