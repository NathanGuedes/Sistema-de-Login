<?php

namespace Providers;

use Contracts\SessionInterface;
use Contracts\UserRepositoryInterface;
use Core\Request;
use Database\DatabaseConnection;
use PDO;
use Repository\UserRepository;
use Services\RegisterService;
use Services\SessionService;
use Support\SessionManager;

class AppServiceProvider
{
    public static function definitions(): array
    {
        return [
            PDO::class => function () {
                return DatabaseConnection::connect();
            },
            UserRepositoryInterface::class => \DI\autowire(UserRepository::class),
            SessionInterface::class => \DI\autowire(SessionManager::class),

            RegisterService::class => \DI\autowire(),
            SessionService::class => \DI\autowire(),

            Request::class => function () {
                return Request::create();
            },
        ];
    }
}