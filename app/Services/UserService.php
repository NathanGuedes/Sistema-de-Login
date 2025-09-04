<?php

namespace Services;

use Contracts\UserRepositoryInterface;
use Models\User;
use Random\RandomException;
use Validators\RegisterFormValidator;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws RandomException
     */
    public function register(array $data): void
    {
        if (! RegisterFormValidator::validate($data)){
            redirect('/register');
        }

        $name = $data['name'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $token = bin2hex(random_bytes(32));

        $user = new User($name, $email, $password, $token);

        $this->userRepository->create($user);
    }
}