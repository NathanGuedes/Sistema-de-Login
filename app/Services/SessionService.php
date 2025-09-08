<?php

namespace Services;

use Contracts\UserRepositoryInterface;
use Exceptions\ValidationException;
use Validators\SessionFormValidator;

class SessionService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws ValidationException
     */
    public function session(array $formData): void
    {
        $error = SessionFormValidator::validate($formData);

        if (!empty($error)) {
            throw new ValidationException($error);
        }

        $user = $this->userRepository->findByEmail($formData['email']);
    }
}