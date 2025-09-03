<?php

namespace Services;

use Contracts\UserRepositoryInterface;
use Repository\UserRepository;

class UserService
{
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register()
    {

    }
}