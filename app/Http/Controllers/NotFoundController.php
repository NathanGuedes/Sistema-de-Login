<?php

namespace Http\Controllers;

use Contracts\ControllerInterface;
use Core\Response;

class NotFoundController implements ControllerInterface
{
    public function __construct()
    {
        http_response_code(404);
    }

    public function index(): Response
    {
        return new Response("Not Found", 404);
    }
}