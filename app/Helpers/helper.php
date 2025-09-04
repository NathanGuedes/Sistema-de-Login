<?php

use JetBrains\PhpStorm\NoReturn;

function basePath(): string
{
    return dirname(__DIR__,2);
}

#[NoReturn]
function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}
