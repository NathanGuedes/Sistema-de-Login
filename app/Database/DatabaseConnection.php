<?php

namespace Database;

use PDO;
use PDOException;

class DatabaseConnection
{
    private static PDO|null $instance = null;

    public static function connect(): PDO
    {
        $dsn = 'mysql:'
            . 'host=' . $_ENV['DB_HOST'] . ';'
            . 'port=' . $_ENV['DB_PORT'] . ';'
            . 'dbname=' . $_ENV['DB_DATABASE'] . ';'
            . 'charset=' . $_ENV['DB_CHARSET'];

        if (static::$instance === null) {
            try{
                static::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            } catch (PDOException $e){
                throw new PDOException($e->getMessage());
            }
        }

        return static::$instance;
    }

}