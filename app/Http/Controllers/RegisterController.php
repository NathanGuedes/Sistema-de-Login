<?php

namespace Http\Controllers;

use Core\Response;
use Exception;

class RegisterController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): Response
    {
        return new Response($this->view('auth/register'));
    }
}