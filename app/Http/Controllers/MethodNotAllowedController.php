<?php

namespace Http\Controllers;

use Contracts\ControllerInterface;
use Core\Response;

class MethodNotAllowedController implements ControllerInterface
{
    public function __construct()
    {
        http_response_code(405);
    }

    public function index(): Response
    {
        return new Response("405 Not Allowed");
    }
}