<?php

use DI\ContainerBuilder;
use Providers\AppServiceProvider;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$builder = new ContainerBuilder();
$builder->addDefinitions(AppServiceProvider::definitions());
$container = $builder->build();

require basePath() . '/app/Routes/web.php';