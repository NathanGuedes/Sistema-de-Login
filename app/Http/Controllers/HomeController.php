<?php

namespace Http\Controllers;


use Contracts\ControllerInterface;
use Core\Response;

class HomeController implements ControllerInterface
{
    public function index(): Response
    {

        return new Response(Controller::view('home'));
    }
}