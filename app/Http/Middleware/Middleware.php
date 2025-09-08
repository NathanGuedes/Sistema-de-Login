<?php

namespace Http\Middleware;

use Exception;

class Middleware
{
    protected const array MAP = [
        'Auth' => Auth::class,
        'guest' => Guest::class
    ];

    /**
     * @throws Exception
     */
    public static function resolve($key): void
    {
        if (! $key){
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if (! $middleware){
            throw new Exception('middleware not found');
        }

        (new $middleware)->handle();

    }
}