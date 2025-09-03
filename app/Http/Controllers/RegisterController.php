<?php

namespace Http\Controllers;

use Core\Request;
use Core\Response;
use Exception;
use Services\UserService;

class RegisterController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Response
    {
        return new Response($this->view('auth/register'));
    }

    public function register(Request $request)
    {
        var_dump($request->post);
        $this->userService->register();
    }
}